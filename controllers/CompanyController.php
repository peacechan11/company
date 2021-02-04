<?php

namespace app\controllers;

use app\models\Category;
use app\models\CompanyCategory;
use Yii;
use app\models\Company;
use app\models\CompanySearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CompanyController implements the CRUD actions for Company model.
 */
class CompanyController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access'=>[
                'class'=>AccessControl::className(),
                'rules'=>[
                    [
                        'allow'=>true,
                        'roles'=>['@']
                    ],

                ]
            ]
        ];
    }

    /**
     * Lists all Company models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CompanySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [

            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Company model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function getCategoryById($id)
    {
        $tempCategory=Category::find()
            ->where(['id' => $id])
            ->one();
        $tempParent = $tempCategory->parent;
        if ($tempParent) {
            return self::getCategoryById($tempParent) . " -> " . $tempCategory->name;
        } else {
            return $tempCategory->name;
        }

    }
       public function actionView($id)
    {
        $company = Company::find()->where(["id" => $id])->all();


        $Category = CompanyCategory::find()->where(['company' => $id])->all();
        $Arr = array();
        $ArrIndex = 0;
        foreach ($Category as $cate) {
            $Arr[$ArrIndex][0] = $cate->id;
            $Arr[$ArrIndex][1] = $this->getCategoryById($cate->category);
            $ArrIndex++;
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
            'company' => $company,
            'Arr' => $Arr
        ]);
    }
    /*
    public function actionView($id){
        return $this->render('view', [
            'model' => $this->findModel($id),

        ]);
    } */
    /**
     * Creates a new Company model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
  /*  public function actionCreate()
    {
        $model = new Company();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }  */
    public function actionCreate()
    {
        $model = new Company();

        if ($model->load(Yii::$app->request->post()) ) {
            $model->created_by = Yii::$app->user->identity->getId();
            if ($model->save(false)) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Company model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Company model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Company model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Company the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Company::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
