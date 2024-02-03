<?php

use yii\grid\GridView;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;



$this->registerJs("var assignRoleUrl = '" . Url::to(['rbac/assign-role']) . "';", \yii\web\View::POS_HEAD);

/* @var $userRoles array */

$dataProvider = new ArrayDataProvider([
    'allModels' => $userRoles,
    'pagination' => [
        'pageSize' => 10,
    ],
]);

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'username',
        [
            'label' => 'Rollen',
            'value' => function ($model) {
                return implode(', ', $model['roles']);
            },
        ],
        [
            'label' => 'geerbte Rollen',
            'value' => function ($model) use ($roleHierarchy) {
                $userRoles = Yii::$app->authManager->getRolesByUser($model['id']);
                $inheritedRoles = [];
                foreach ($userRoles as $role) {
                    $inheritedRoles = array_merge($inheritedRoles, $roleHierarchy[$role->name] ?? []);
                }
                return implode(', ', array_unique($inheritedRoles));
             }
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{assign}',
            'buttons' => [
                'assign' => function ($url, $model, $key) {
                    $userRolesJson = json_encode(array_values($model['roles']));
                    return Html::button('Rolle zuordnen', [
                        'class' => 'btn btn-success btn-sm role-assign-button',
                        'onclick' => "openRoleAssignmentModal({$model['id']}, '{$userRolesJson}')",
                    ]);
                },
            ],
        ],
    ],
]);

// JavaScript for opening role assignment modal
$script = <<< JS
function openRoleAssignmentModal(userId, userRolesJson) {
    var userRoles;
    try {
        userRoles = JSON.parse(userRolesJson);
    } catch (e) {
        console.error("Error parsing JSON: ", e);
        return;
    }
    $('#userId').val(userId);

    // Pre-select the user's current roles
    var select = $('#roleSelect');
    select.find('option').each(function() {
        $(this).prop('selected', userRoles.includes($(this).val()));
    });

    $('#roleAssignmentModal').modal('show');
}


$(document).ready(function() {
    $('#roleAssignmentForm').on('submit', function(e) {
        e.preventDefault();

        var formData = $(this).serialize(); // Serialize form data

        // AJAX request to server to assign role
        $.ajax({
            url: assignRoleUrl, 
            type: 'POST',
            data: formData,
            success: function(response) {
                $('#roleAssignmentModal').modal('hide');
                location.reload();
            },
            error: function() {
                // Handle error
                alert('Error assigning role');
            }
        });
    });
});

JS;
$this->registerJs($script, \yii\web\View::POS_END);
?>

<!-- Role Assignment Modal -->
<div class="modal fade" id="roleAssignmentModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="roleAssignmentForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Rollen zuordnen</h5>
                    <button type="button" class="btn btn-close cm-btn-close" data-bs-dismiss="modal" aria-label="Schließen"></button>
                </div>
                <div class="modal-body">
                    <!-- Role Selection Form -->
                    <input type="hidden" id="userId" name="userId" value="">
                    <div class="form-group">
                        <label for="roleSelect">Role</label>
                        <select class="form-control" id="roleSelect" name="roleNames[]" multiple>
                            <?php foreach (Yii::$app->authManager->getRoles() as $role) : ?>
                                <option value="<?= $role->name ?>"><?= $role->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="text-sm-start">Mehrfachauswahl möglich</div>
                    <button type="button" class="btn btn-sm" data-bs-dismiss="modal">Schließen</button>
                    <button type="submit" class="btn btn-sm">Speichern</button>
                </div>
            </form>
        </div>
    </div>
</div>