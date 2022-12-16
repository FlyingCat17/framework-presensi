<?php 
/*---##########################---usage example---##########################---
|
|  ========================= Query Builder =========================
|
|  ---------------------------- Select ----------------------------
|  Model::get();
|  Model::where('id', 1)->get();
|  Model::where('id', 1)->first();
|  Model::where('id', 1)->update(['name' => 'Riyu'])->save();
|  Model::where('id', 1)->delete();
|  Model::where('id', 1)->delete()->save();
|
|  ---------------------------- Insert ----------------------------
|  Model::insert(['name' => 'Riyu'])->save();
|
|  ---------------------------- Update ----------------------------
|  Model::update(['name' => 'Riyu'])->save();
|
|  ---------------------------- Delete ----------------------------
|  Model::delete()->save();
|
|  ---------------------------- Join --------------------------------
|  Model::join('table', 'table.id', '=', 'model.id')->get();
|  Model::join('table', 'table.id', '=', 'model.id')->where('model.id', 1)->get();
|  Model::join('table', 'table.id', '=', 'model.id')->where('model.id', 1)->first();
|  Model::innerjoin('table', 'table.id', '=', 'model.id')->get();
|
|  ---------------------------- Order By ----------------------------
|  Model::orderBy('id', 'desc')->get();
|  Model::orderBy('id', 'asc')->first();
|  Model::orderBy('id', 'desc')->where('id', 1)->get();
|  Model::orderBy('id', 'asc')->where('id', 1)->first();
|
|  ---------------------------- Group By ----------------------------
|  Model::groupBy('id')->get();
|  Model::groupBy('id')->first();
|  Model::groupBy('id')->where('id', 1)->get();
|  Model::groupBy('id')->where('id', 1)->first();
|
|  ---------------------------- Having ----------------------------
|  Model::having('id', '>', 1)->get();
|  Model::having('id', '>', 1)->first();
|  Model::having('id', '>', 1)->where('id', 1)->get();
|  Model::having('id', '>', 1)->where('id', 1)->first();
|
|  ---------------------------- Limit ----------------------------
|  Model::limit(1)->get();
|  Model::limit(1)->first();
|  Model::limit(1)->where('id', 1)->get();
|  Model::limit(1)->where('id', 1)->first();
|
|
|  ========================= Routing =========================
|
|  ---------------------------- Get ----------------------------
|  Route::get('/', [Controller::class, 'index']);
|  Route::get('/', [Controller::class]); // if method name is index
|  Route::get('/form', [Controller::class, 'index']);
|  Route::get('/form/{id}', [Controller::class, 'index']);
|  Route::get('/form/{id}', [Controller::class, 'index']);
|  Route::get('/form/{id}/{name}', [Controller::class, 'index']);
|  Route::get('/user/{id}/profile', [Controller::class, 'index']);
|  Route::get('/user/{id}/profile/{name}', function ($id, $name) {
|      echo $id;
|      echo $name;
|  });
|  Route::get('/user/{id}/profile/{name}', function (Request $request) {
|      echo $request->id;
|      echo $request->name;
|  });
|  
|  ---------------------------- Post ----------------------------
|  Route::post('/', [Controller::class, 'index']);
|  Route::post('/', [Controller::class]); // if method name is index
|  Route::post('/form', [Controller::class, 'index']);
|  Route::post('/form/{id}', [Controller::class, 'index']);
|  Route::post('/form/{id}', [Controller::class, 'index']);
|
|
| ========================= Controller =========================
| 
| ---------------------------- Get ----------------------------
| public function index()
| {
|     return view('index');
| }
|
| public function index($id)
| {
|     return view('index', ['id' => $id]);
| }
|
| public function index($id, $name)
| {
|     return view('index', ['id' => $id, 'name' => $name]);
| }
|
| public function index(Request $request)
| {
|     return view('index', ['id' => $request->id, 'name' => $request->name]);
| }
|
|
| ========================= View =========================
|
|  ---------------------------- Get ----------------------------
|  <h1>Hello World</h1>
|  <h1>Hello <?= $data['hello'] ?></h1>
|  <h1>Hello <?= $data['hello'] ?? 'World' ?></h1>
|
| ---------------------------- Loop ----------------------------
|  <?php foreach ($data as $key => $value) : ?>
|      <h1>Hello <?= $value ?></h1>
|  <?php endforeach; ?>
|
|
|  ========================= Validation =========================
|
|   ---------------------------- Rules ----------------------------
|   required
|   email
|   min:6 (min length)
|   max:12 (max length)
|   confirmed (password_confirmation)
|
|  ---------------------------- Custom Message ----------------------------
|  $messages = [
|      'name' => 'This field is required',
|      'email' => 'This field must be a valid email',
|      'password' => 'This field must be at least 6 characters'
|  ];
|
| ---------------------------- Usage ----------------------------
|  $data = [
|      'name' => 'Riyu',
|      'email' => 'riyu',
|      'password => '123456',
|      'password_confirmation' => '1234567'
|  ];
|  $rules = [
|      'name' => 'required',
|      'email' => 'required|email',
|      'password' => 'required|min:6|max:12|confirmed'
|  ];
|  $errors = Validation::make($data, $rules);
|  if ($errors) {
|      $errors = Validation::customMessage($errors, $messages);
|      return view('index', ['errors' => $errors]);
|  }
|
|  with customMessage method
|  $data = [
|      'name' => 'Riyu',
|      'email' => 'riyu',
|      'password => '123456',
|      'password_confirmation' => '1234567'
|  ];
|  $rules = [
|      'name' => 'required',
|      'email' => 'required|email',
|      'password' => 'required|min:6|max:12|confirmed'
|  ];
|  $messages = [
|      'name' => 'This field is required',
|      'email' => 'This field must be a valid email',
|      'password' => 'This field must be at least 6 characters'
|  ];
|
|  $errors = Validation::make($data, $rules);
|  if ($errors) {
|      return view('index', ['errors' => $errors]);
|  }
|
|
|   ---------------------------- Update Message ----------------------------
|
|   $messages = [
|       'required' => ':field is required',
|       'email' => ':field must be a valid email',
|       'min' => ':field must be at least :min characters',
|       'max' => ':field must be at least :max characters',
|       'confirmed' => ':field must be confirmed'
|   ];
|
|   $rules = [
|       'name' => 'required',
|       'email' => 'required|email',
|       'password' => 'required|min:6|max:12|confirmed'
|   ];
|
|   $errors = Validation::message($_POST, $rules, $messages);
|
|
|
|
|
*/