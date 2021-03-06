<?php
use App\Post;
use App\Tag;
use App\User;
use App\Role;
use App\Country;
use App\Photo;
use App\Video;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


/*
Route::get('/about', function () {
    return 'HI ABOUT PAGE!!!!';
});

Route::get('/contact', function () {
    return 'HI CONTACT PAGE!!!!';
});

//Route parameters
Route::get('/post/{id}/{name}', function ($id, $name) {
    return 'My post number '.$id. ' with name '.$name;
});

Route::get('admin/posts/example', array('as' => 'admin.home', function() {
    $url = route('admin.home');
    return 'This URL is ' .$url;
}));
*/

//Route::get('/posts', 'PostsController@index');
//Route::get('/posts/{id}', 'PostsController@show');

//Create resource for all methods in the controller
//Route::resource('posts', 'PostsController');

/*
Route::get('/contact', 'PostsController@contact');
Route::get('/post/{id}', 'PostsController@showPost');
*/

/*
|--------------------------------------------------------------------------
| Raw queries
|--------------------------------------------------------------------------
 */

Route::get('/ref/insert', function(){
    DB::insert('insert into posts (title, body) values (?, ?)', ['PHP WITH LARAVE', 'PHP Laravel is a nice think to learn']);
});
/*
Route::get('/read', function(){
    $results= DB::select('select * from posts where id=?', [1]);

    return $results;
    foreach ($results as $post){
        return $post->title;
    }
});

Route::get('/update', function(){
   $updated = DB::update('update posts set title="Updated title" where id=?', [1]);
   return $updated;
});

Route::get('/delete', function(){
    $deleted = DB::delete('delete from posts where id=?', [1]);
    return $deleted;
});
*/

/*
|--------------------------------------------------------------------------
| ELOQUENT queries
|--------------------------------------------------------------------------
 */

Route::get('/ref/read', function(){
    $posts = Post::all();
    return $posts;
});

Route::get('/ref/find/{id}', function($id){
    $post = Post::find($id);
    return $post;
});

Route::get('/ref/find-where/{id}', function($id){
    $posts = Post::where('id', $id)->orderBy('id', 'desc')->take(1)->get();
    return $posts;
});

Route::get('/ref/find-more/{id}', function($id){
    //Show a friendly message if not found
    //$post = Post::findOrFail($id);
    //return $post;

    $posts = Post::where('users_count', '<', 50)->firstOrFail();
    return $posts;
});

Route::get('/ref/basic-insert', function(){
    $post = new Post;
    $post->title = 'new Title';
    $post->body = 'New body';

    $post->save();
});

Route::get('/ref/basic-update/{id}', function($id){
    $post = Post::findOrFail($id);
    $post->title = 'updated Title';
    $post->body = 'updated body';

    $post->update();
});

//Create multiple records
Route::get('/ref/create', function(){
    Post::create([
        'title'=>'The create method',
        'body'=>'It really does work'
    ]);
});

//Update
Route::get('/ref/update/{id}', function($id){
    Post::where('id', $id)->where('is_admin', 0)->update([
        'title'=>'The UPDATE method',
        'body'=>'UPDATE! It really does work'
    ]);
});

//Delete
Route::get('/ref/delete/{id}', function($id){
    $post = Post::findOrFail($id);
    $post->delete();
});

//Delete
Route::get('/ref/destroy/{id}', function($id){
    //Post::destroy($id);
    Post::where('id', $id)->delete();
});

Route::get('/ref/destroy-multiple', function(){
    Post::destroy([0, 1]);
});

Route::get('/ref/softdelete/{id}', function($id){
    $post = Post::findOrFail($id)->delete();
});

//Delete the item permanently
Route::get('/ref/force-delete/{id}', function($id){
    return Post::onlyTrashed()->where('id', $id)->forceDelete();
});

Route::get('/ref/read-deleted', function(){
    return Post::onlyTrashed()->get();
});

Route::get('/ref/read-deleted/{id}', function($id){
    return Post::withTrashed()->where('id', $id)->get();
});

Route::get('/ref/restore/{id}', function($id){
    return Post::withTrashed()->where('id', $id)->restore();
});

/*
|--------------------------------------------------------------------------
| ELOQUENT relationships
|--------------------------------------------------------------------------
 */

//OneToOne
Route::get('/ref/user/{id}/post', function($id){
    $user = User::findOrFail($id);
    return $user->post;
});

//OneToOne inverse
Route::get('/ref/post/{id}/user', function($id){
    $post = Post::findOrFail($id);
    return $post->user;
});

//OneToMany
Route::get('/ref/user/{id}/posts', function($id){
    $user = User::findOrFail($id);
    return $user->posts;
});

//ManyToMany
Route::get('/ref/user/{id}/roles', function($id){
    return User::findOrFail($id)->roles()->orderBy('id', 'desc')->get();
});

//ManyToMany
Route::get('/ref/role/{id}/users', function($id){
    return Role::findOrFail($id)->users;
});

//ManyThrough
Route::get('/ref/country/{id}/posts', function($id){
    return Country::findOrFail($id)->posts;
});

/*
|--------------------------------------------------------------------------
| POLYMORPHIC relationships
|--------------------------------------------------------------------------
 */

Route::get('/ref/user/{id}/photos', function($id){
    return User::findOrFail($id)->photos;
});

Route::get('/ref/post/{id}/photos', function($id){
    $photos = Post::findOrFail($id)->photos;
    return $photos;
});

Route::get('/ref/photo/{id}/entity', function($id){
    $photo = Photo::findOrFail($id);
    //It returns a User or a Post
    return $photo->imageable;
});

//Polymorphic ManyToMany
Route::get('/ref/post/{id}/tags', function($id){
    return Post::findOrFail($id)->tags;
});

Route::get('/ref/video/{id}/tags', function($id){
    return Video::findOrFail($id)->tags;
});

Route::get('/ref/tags/{id}/videos', function($id){
    return Tag::find($id)->videos;
});

Route::get('/ref/tags/{id}/posts', function($id){
    return Tag::find($id)->posts;
});

/*
|--------------------------------------------------------------------------
| CRUD APPLICATION
|--------------------------------------------------------------------------
 */
Route::resource('/posts', 'PostsController');