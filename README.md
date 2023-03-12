## Simple fully functional Blog App with bootsrap 5 and MySql

Here are the steps you need to make to test the app.

- Create Database
- Setup database connection in .env file.
- Run migrations.
- Run admin seeder.
```
php artisan db:seed --class=AdminUserSeeder
```
- User is able to register, login and logout of the application.
- User is able to create, edit and delete only his blog posts.
- Each blog have a title, content, slug, and an image. 
- Images are stored in Publuc blog-images Folder.
- For unique slugs Eloquent Sluggable Package is used.
- There is an admin panel available only for admin user. Admin user can edit, delete all posts from all users.
- Laravel's built-in authentication system for user authentication and authorization.
- Laravel's built-in form validation to ensure that all fields are filled out correctly.
- There is a search bar where user can search for posts.
- Every post is accessible by the slug, therefore slug must be unique.
- FontAwsome is used for icons
- Pagination is implemented, 5 posts per page
- When you are editin a post, image is not mandatory, if you select new picture, the old one will be replaced and deleted
- There is commenting on every post implemented. Every user can comment, the difference is that if user is not logged in, he will need to write his Name, if user is registered, his registered name will be used.
- If you delete a post, all comments related to that post weill be deleted also.
- Notification is implemented, on every comment user will receive an emal. Mailtrap is used to test email notification.
- User thortling implemented. First time u have to wait 2x3 minutes, on every unsuccessful attempt waiting time is increased by 2 mins. Ex. 6,8,10 etc.
