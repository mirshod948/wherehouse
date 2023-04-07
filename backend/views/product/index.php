<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="table-responsive">
        <?= GridView::widget([
            'id'=>'grid-view',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\CheckboxColumn'],
                [
                    'attribute' => 'id',
                    'contentOptions' => [
                        'style' => 'width: 60px'
                    ]
                ],
                [
                    'label' => 'Image',
                    'attribute' => 'image',
                    'content' => function ($model) {
                        /** @var \common\models\Product $model */
                        return Html::img($model->getImageUrl(), ['style' => 'width: 50px']);
                    }
                ],
                [
                    'attribute' => 'name',
                    'content' => function ($model) {
                        return \yii\helpers\StringHelper::truncateWords($model->name, 7);
                    }
                ],
                'price:currency',
                [
                    'attribute' => 'status',
                    'content' => function ($model) {
                        /** @var \common\models\Product $model */
                        return Html::tag('span', $model->status ? 'Active' : 'Draft', [
                            'class' => $model->status ? 'badge badge-success' : 'badge badge-danger'
                        ]);
                    }
                ],
                [
                    'attribute'=>'selling_price',
                ],
                [
                    'attribute' => 'created_at',
                    'format' => ['datetime'],
                    'contentOptions' => ['style' => 'white-space: nowrap']
                ],
                [
                    'attribute' => 'updated_at',
                    'format' => ['datetime'],
                    'contentOptions' => ['style' => 'white-space: nowrap']
                ],
                //'created_by',
                //'updated_by',

                [
                    'class' => 'common\grid\ActionColumn',
                    'contentOptions' => [
                        'class' => 'td-actions'
                    ]
                ],
            ],
        ]); ?>
        <?= Html::beginForm(['bulk-update'], 'post', ['id' => 'bulk-update-form']); ?>
<?= Html::endForm(); ?>

<?= Html::button('Update Selected', [
    'class' => 'btn btn-primary',
    'onclick' => 'updateSelected()'
]); ?>




<?php
$js = <<<JS
function updateSelected() {
    var keys = $('#grid-view').yiiGridView('getSelectedRows');
    if (keys.length == 0) {
        alert('Please select at least one record.');
        return false;
    } else {
        $('#bulk-update-form').attr('action', ['bulk-update']);
        $('#bulk-update-form').submit();
    }
}
JS;
$this->registerJs($js);
?>
    </div>


</div>
