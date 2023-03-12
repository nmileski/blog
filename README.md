## Simple fully functional Blog App

Here are the steps you need to make to test the app.

- Create Database
- Setup database connection in .env file.
- Run migrations.
- Run admin seeder.
```
php artisan db:seed --class=AdminUserSeeder
```
- Images are stored in Publuc blog-images Folder
- For unique slugs Eloquent Sluggable Package is used
- FontAwsome is used for icons
- When you are editin a post, image is not mandatory, if you select new picture, the old one will be replaced and deleted.
- There is comment on every post implemented.
- If you delete a post, all comments related to that post weill be deleted also.
- User thortling implemented. First time u have to wait 2x3 minutes, on every unsuccessful attempt waiting time is increased by 2 mins. Ex. 6,8,10 etc.
