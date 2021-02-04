<?php

namespace app\controllers;

use app\models\Category;
use app\models\Company;
use app\models\CompanySearch;
use app\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;


class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
   /* public function actionIndex()
    {
        return $this->render('index');
    } */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/site/login');
        } else {
            $searchModel = new CompanySearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $company= new ActiveDataProvider([
                'query' => Company::find(),

            ]);
            $category=new ActiveDataProvider(['query'=>Category::find(),]);
            return $this->render('index', [
                'company' => $company, 'searchModel' => $searchModel,'dataProvider' => $dataProvider,
            ]);
        }
    }
    public function actionDelete($id)
    {
        $company = new Company();
if (Yii::$app->user->id == $company->createdBy->id){
        \Yii::$app
            ->db
            ->createCommand()
            ->delete('company', ['id' => $id])
            ->execute();
}
        return $this->redirect(['index']);
    }
    public function actionUpdate($id)
    {
        return $this->redirect('/company/update?id=' . $id);
    }

    public function actionView($id)
    {
        return $this->redirect('/company/view?id=' . $id);
    }
   public function actionCreate()
    {
        $company = new Company();


            if ($company->load(Yii::$app->request->post())) {
                $company->created_by = Yii::$app->user->identity->getId();
                if ($company->save(false)) {
                    $this->saveCompanyCategory($company->id);
                    return $this->redirect(['view', 'id' => $company->id]);
                }
            }

        $category = Category::find()->all();
        return $this->render('create', ['category' => $category]);
    }
   public function saveCompanyCategory($company)
    {
        $categoryData = $_POST['category'];
        if (isset($categoryData)) {
            foreach ($categoryData as $category) {
                Yii::$app->db->createCommand()
                    ->insert('company_category', ['company' => $company, 'category' => $category])
                    ->execute();
            }
            return $this->redirect('/company/view?id=' . $company);
        } else
            return $this->redirect('/');
    }



    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();


        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    public function actionRegister()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // form inputs are valid, do something here
                $model->username=$_POST['User']['username'];
                $model->email=$_POST['User']['email'];
                $model->password=password_hash($_POST['User']['password'],PASSWORD_ARGON2I);
                $model->authKey=md5(random_bytes(5));
                $model->accessToken=password_hash(random_bytes(10),PASSWORD_DEFAULT);
                if($model->save()){
                    return $this->redirect(['login']);
                }
            }
        }

        return $this->render('register', [
            'model' => $model,
        ]);
    }
}
