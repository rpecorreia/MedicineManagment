<?php


Auth::routes();

Route::get('/admin', 'AdminControlador@index')->name('admin.dashboard');

Route::get('/admin/login', 'Auth\AdminLoginController@index')->name('admin.login');

Route::post('/admin/login', 'Auth\AdminLoginController@login')->name('admin.submit');

Route::get('/admin/definicoes', 'AdminControlador@settings')->name('admin.settings');
Route::post('/admin/definicoes','AdminControlador@changePassword')->name('admin.changePassword');

Route::get('/admin/alterarconta/{id}', 'AdminControlador@edituser')->name('user.edit');

Route::post('/admin/alterarconta/{id}', 'AdminControlador@updateuser')->name('user.update');

//Route::any('/admin/removerconta/{id}', 'AdminControlador@destroyuser')->name('user.destroy');

Route::get('/admin/contaslistar', 'ContaControlador@listar')->name('contaslistar');

Route::get( '/admin/contascriar', 'ContaControlador@criar')->name('contascriar');

Route::get( '/admin/inserirmed', 'AdminControlador@inserirNovoMed')->name('admin.criarmed');

Route::get( '/admin/inserirmed', 'AdminControlador@inserirMedExistente')->name('admin.criarmedexistente');

Route::post( '/admin/inserirmed', 'AdminControlador@storeMed')->name('admin.storemed');

Route::get( '/admin/inserirmed/editar/{id}', 'AdminControlador@editMedExistente')->name('admin.editmedexistente');

Route::post('/admin/inserirmed/{id}', 'AdminControlador@update')->name('admin.updatemedexistente');;

Route::get('/admin/listarmedlocal', 'AdminControlador@listarMedLocal')->name('admin.listarmedlocal');

//Route::get('/admin/listarmedlocal/apagar/{id}', 'AdminControlador@destroy')->name('admin.deletemedlocal');

Route::get('/admin/listarmedlocal/editar/{id}', 'AdminControlador@editMedLocal')->name('admin.editmedlocal');

Route::post('/admin/listarmedlocal/{id}', 'AdminControlador@updateMedLocal')->name('admin.updatemedlocal');

Route::get('/admin/listarmedglobal', 'AdminControlador@listarMedGlobal')->name('admin.listarmedglobal');

Route::get('/admin/fazerpedido', 'AdminControlador@fazerPedido')->name('admin.fazerpedido');

Route::post('/admin/fazerpedido', 'AdminControlador@store')->name('admin.storepedido');

Route::get('/admin/pedidosenviados', 'AdminControlador@pedidosEnviados')->name('admin.pedidosenviados');

Route::get('/admin/pedidosenviados/{id}', 'AdminControlador@pedidosEnviadosID')->name('admin.pedidosenviados.id');

Route::post('/admin/pedidosenviados/confirm/{id}', 'AdminControlador@confirm')->name('admin.confirm');

Route::get('/admin/pedidosrecebidos', 'AdminControlador@pedidosRecebidos')->name('admin.pedidosrecebidos');

Route::get('/admin/pedidosrecebidos/{id}', 'AdminControlador@pedidosRecebidosID')->name('admin.pedidosrecebidos.id');

Route::post('/admin/pedidosrecebidos/confirm/{id}', 'AdminControlador@confirmenvio')->name('admin.confirmenvio');

Route::post('/admin/pedidosrecebidos/reject/{id}', 'AdminControlador@rejectenvio')->name('admin.rejectenvio');

Route::get('/admin/movimentos', 'AdminControlador@movimentos')->name('admin.movimentos');

Route::any('/admin/movimentos/filtro', 'AdminControlador@movimentosFiltro')->name('admin.movimentosFiltro');

Route::any('/admin/contactos', 'AdminControlador@contactos')->name('admin.contactos');

Route::any('/admin/contactos/filtro', 'AdminControlador@contactosFiltro')->name('admin.contactosFiltro');


//FARMACEUTICO

Route::get('/', 'HomeController@index')->name('dashboard');

Route::get('/listarmedlocal', 'MedicamentoControlador@listarMedLocal')->name('listarmedlocal');

Route::get('/listarmedlocal/editar/{id}', 'MedicamentoControlador@editMedLocal')->name('editmedlocal');

Route::post('/listarmedlocal/{id}', 'MedicamentoControlador@updateMedLocal')->name('updatemedlocal');

Route::get('/listarmedglobal', 'MedicamentoControlador@listarMedGlobal')->name('listarmedglobal');

Route::get('/fazerpedido', 'PedidoControlador@fazerPedido')->name('fazerpedido');
Route::post('/fazerpedido', 'PedidoControlador@store')->name('storepedido');

Route::get('/pedidosenviados', 'PedidoControlador@pedidosEnviados')->name('pedidosenviados');

Route::get('/pedidosenviados/{id}', 'PedidoControlador@pedidosEnviadosID')->name('pedidosenviados.id');

Route::post('/pedidosenviados/confirm/{id}', 'PedidoControlador@confirm')->name('confirm');

Route::get('/pedidosrecebidos', 'PedidoControlador@pedidosRecebidos')->name('pedidosrecebidos');

Route::get('/pedidosrecebidos/{id}', 'PedidoControlador@pedidosRecebidosID')->name('pedidosrecebidos.id');

Route::post('/pedidosrecebidos/confirm/{id}', 'PedidoControlador@confirmenvio')->name('confirmenvio');

Route::post('/pedidosrecebidos/reject/{id}', 'PedidoControlador@rejectenvio')->name('rejectenvio');

Route::get('/movimentos', 'MovimentoControlador@movimentos')->name('movimentos');

Route::any('/movimentos/filtro', 'MovimentoControlador@movimentosFiltro')->name('movimentosFiltro');

Route::any('/contactos', 'HomeController@contactos')->name('contactos');

Route::any('/contactos/filtro', 'HomeController@contactosFiltro')->name('contactosFiltro');

Route::get('definicoes', 'HomeController@settings')->name('settings');
Route::post('definicoes','HomeController@changePassword')->name('changePassword');

