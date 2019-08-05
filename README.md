# instagrah
Instagram clone made in Laravel PHP framework.

# Project structure:
## Controllers:
- Auth (LoginController, RegisterController, VerificationController, ForgotPasswordController, ResetPasswordController, VerificationController)
- Controller (main)
- HomeController
- PostsController
- ProfilesController

## Models:
- Post (defined relation to user)
- Profile (defined with user data)
- User (defined relations with posts and profile)

## Database:
- SQLite

### Public folder has a symbolic link used for storing uploaded photos in posts.

## Resources (views):
- Auth (Register template has username field added)
- Posts - Create
- Profiles - Index
- Welcome page

## Routes:
- GET Create Post
- POST Create Post
- GET Post by id
- GET User profile

## Custom methods from controllers:
### PostsController@__construct
- Auth middleware performs a check for each accessed method if the user is logged in. Only in that case methods will be accessible.

### PostsController@store
- Data from form gets validated.
- Image is uploaded to its public directory.
- Using Intervention PHP Library image is set to fit exact size.
- Post is being formed with its caption and image.
- User is redirected to its profile. 

### PostsController@show(TODO)
- Display single post from user.

### ProfilesController@index
Try finding user. On success, return user to view. On failure show 404.


## Models:
- Post ( protected guarded is an empty array to avoid using fillable property, user method returns user that created the post)
- Profile ( user method returns user who belongs to the profile)
- User ( has defined one to many relationship to posts and one to one relationship to profile)

### Create post blade template is using CSRF protection to ensure that only authenticated user can create a post.
