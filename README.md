# flea-market-app1  


## 環境構築  
### Dockerビルド  
1. git clone git@github.com:coachtech-material/laravel-docker-template.git  

 mv laravel-docker-template flea-market-app1  

2. DockerDesktopアプリの立ち上げ  
3. docker-compose up -d --build  
### Laravel環境構築  
1. docker-compose exec php bash  
2. composer install  
3. .envに環境変数を追加  
    DB_HOST = mysql  
    DB_DATABASE=laravel_db  
    DB_USERNAME=laravel_user  
    DB_PASSWORD=laravel_pass  
4. アプリケーションキーの作成  
    php artisan key:generate  
5. マイグレーションの実行  
    php artisan migrate  
  
## 使用技術（実行環境）  
 - PHP7.4.9  
 - Laravel8.83.29  
 - MySQL8.0.26  


## URL
- 開発環境：http://localhost/  

- phpMyAdmin:http://localhost:8080/  
