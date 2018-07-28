### Laravel Base Repository

#### Description
A wrapper around eloquent's main features so you can share them among your own repositories

#### Installation
In order to install this package, all you have to do is execute the following line in your console
` composer require inquiloper/laravel-baserepository `

Then in your repositories 

```PHP
    use Inquiloper\BaseRepository;
    use App\User;
    class UsersRepository extends from BaseRepository implements UsersRepositoryInterface {

        public function __construct(User $user){
            parent::__construct($user);
        }
    }

```

That's it, you're ready to rock now!

#### Documentation

Let's suppose you have this function in your controller where you type-hint your repo

` public function users(UsersRepositoryInterface $usersRepo){} `

Now, the methods you have available are:

###### Find all elements of the model
` $usersRepo->findAll()`

###### Find one element by $field
` $usersRepo->findOneBy(Array $fields) `

###### Find All elements by $fields
` $usersRepo->findAllBy(Array $fields) `

###### Create and save to the DB
` $usersRepo->create(Array $data)`

###### Update with $data by $fields 
` $usersRepo->updateBy(Array $fields, Array $data) `
    public function with($relationships);

###### Update with $data by $fields 
` $usersRepo->updateBy(Array $fields, Array $data) `

###### Delete by $fields
` $usersRepo->deleteBy(Array $fields) `

###### Eager-load relationships
` $usersRepo->with(['posts', 'comments'])->findOneBy(['id' => 1]) `

###### Dynamic methods

You can call the findOneBy method with a dynamic name like so:

` $usersRepo->findOneByName('John Doe') `

This will translate to `select * from users where name = 'John Doe' limit 1 `

> The dynamic calling will automatically snake_case anything after findOneBy , so Name converts to name, UserEmail to user_email and so on.
> You can turn this off and the method will add the where clause with the literal name 

` $usersRepo->findOneByWpEmail('email@example.com' , false) `

This will translate to ` select * from users where WpEmail = 'email@example.com' limit 1 `
