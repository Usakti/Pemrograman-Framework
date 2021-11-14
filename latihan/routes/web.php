<?php

use App\Http\Controllers\DocumentController;
use Illuminate\Support\Facades\Route;

    Route::get('/','AutentikasiController@index')->name('loginPage');
    Route::post('/login','AutentikasiController@login')->name('login');
    Route::post('/register', 'AutentikasiController@register')->name('register');

    Route::group(['middleware' => 'AutentikasiMiddleware'], function() {
        Route::get('/dashboard','LatihController@index')->name('index');
        Route::get('/updateData/{id}', 'LatihController@showViewUpdateData')->name('showViewUpdateData');
        // add data, update data,delete data
        Route::post('/addData', 'LatihController@addData')->name('addData');
        Route::post('/updateData', 'LatihController@updateData')->name('updateData');
        Route::get('/deleteData/{id}', 'LatihController@deleteData')->name('deleteData');

        //file upload, download, and delete
        Route::get('/file', 'DocumentController@view')->name("file");
        Route::post('/addFile', 'DocumentController@insert')->name('addFile');
        Route::get('/download/{url}', 'DocumentController@download');
        Route::get('/deleteFile/{id}', 'DocumentController@deleteFile')->name('deleteFile');
        Route::get('/download-pdf', 'LatihController@downloadPDF')->name('download-pdf');
        Route::get('/download-excel', 'LatihController@exportExcel')->name('download-excel');
        Route::post('/import-excel', 'LatihController@importExcel')->name('import-excel');

        Route::get('/logout', 'AutentikasiController@logout')->name('logout');
    });
?>
