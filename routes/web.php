<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/login1', function () {
    return view('auth.login');
});

Auth::routes();

/**************** start of FileManager***************/

//Folder-start
Route::post('/Folder/Creater','FileManager\FolderController@FolderCreate')->name('Folder.Create');
Route::delete('/Folders/Delete','FileManager\FolderController@FolderDelete')->name('Folder.Delete');
Route::get('/Folder/Details/{id}','FileManager\FolderController@GetDetails')->name('Folder.GetDetails');
Route::put('/Folder/Update/{id}','FileManager\FolderController@UpdateDetails')->name('FolderDetails.Update');
Route::get('/Folders', 'FileManager\ViewerController@SeparateFolders')->name('SeparateFolder.Show');
Route::get('/Folder/Files/{folder_id}/{FileType}/{View}','FileManager\ViewerController@FolderFiles')->name('FolderFiles.Show');
Route::get('/Folder/MyFiles/{folder_id}/{my_files}/{FileType}/{View}','FileManager\AMViewerController@FolderMyFiles')->name('FolderMyFiles.Show');
//Folder-end

//File-start
Route::post('/Folders/SingalFile/Upload','FileManager\FilesUploadController@SingalFileUpload')->name('SingalFile.Upload');
Route::post('/Folders/MultipleFiles/Upload','FileManager\FilesUploadController@MultipleFilesUpload')->name('MultipleFiles.Upload');
Route::get('/File/Details/{id}','FileManager\FilesEditController@GetDetails')->name('File.GetDetails');
Route::put('/File/Update/{id}','FileManager\FilesEditController@UpdateDetails')->name('File.Update');
Route::get('/File/Download/{id}','FileManager\FilesDownloadController@DownloadFiles')->name('Files.Download');
Route::delete('/Files/Delete','FileManager\FilesDeleteController@DeleteAllFiles')->name('AllFiles.Delete');
Route::delete('/MyFiles/Delete','FileManager\FilesDeleteController@DeleteMyFiles')->name('MyFiles.Delete');
Route::get('/File/ShowDetails/{id}','FileManager\ViewerController@FileDetails')->name('FileDetails.Show');
Route::post('/Files/Approve','FileManager\FilesEditController@MultipleApprove')->name('Files.Approve');
//File-end

//Submission-start
Route::get('/FileSubmissions/All','FileManager\FileSubmissionController@AllFileSubmissions')->name('AllFileSubmissions.Show');
Route::get('/FileSubmissions/CreateForm','FileManager\FileSubmissionController@CreateForm')->name('FileSubmissionCreateForm.Show');
Route::post('/FileSubmissions/New','FileManager\FileSubmissionController@Creater')->name('FileSubmission.Create');
Route::delete('/FileSubmissions/Delete','FileManager\FileSubmissionController@Delete')->name('FileSubmission.Delete');
Route::get('/FileSubmissions/Details/{id}','FileManager\FileSubmissionController@GetDetails')->name('FileSubmission.GetDetails');
Route::put('/FileSubmissions/Update/{id}','FileManager\FileSubmissionController@UpdateDetails')->name('FileSubmission.Update');
Route::get('/FileSubmissions/RecordsList/{id}','FileManager\FileSubmissionController@SubmissionFilesList')->name('SubmissionFilesList.Show');

Route::delete('/Submission/SubmissionRecords/Remove','FileManager\FileSubmissionController@SubmissionRecordsRemove')->name('SubmissionRecords.Remove');
Route::get('/Submissions/MyRecords','FileManager\FileSubmissionController@MyFileSubmissionsList')->name('MyFileSubmissionsList.Show');
Route::post('/Submission/File/Submit/{id}','FileManager\FileSubmissionController@SubmissionFileUpload')->name('SubmissionFile.Upload');
Route::put('/Submission/File/Edit/{id}','FileManager\FileSubmissionController@SubmissionFileEdit')->name('SubmissionFile.Edit');
Route::delete('/Submission/File/Delete','FileManager\FileSubmissionController@SubmissionFileDelete')->name('SubmissionFile.Delete');
Route::get('/Submission/File/Download/{id}','FileManager\FileSubmissionController@SubmissionFileDownload')->name('SubmissionFile.Download');
Route::get('/Submission/ZipFile/Create/{id}','FileManager\FileSubmissionController@CreateZipFile')->name('SubmissionZipFile.Create');
Route::post('/Submission/FileType/Add','FileManager\FileTypeController@Add')->name('SubmissionFileType.Add');
Route::get('/Submission/FileType','FileManager\FileTypeController@FileType')->name('SubmissionFileType.Show');
Route::get('/Submission/FileType/Remove/{id}','FileManager\FileTypeController@Remove')->name('SubmissionFileType.Remove');
//Submission-end

//Summary-start
Route::get('/Summary','FileManager\SummaryController@ArchiveSummary')->name('AchiveFileSummary.Show');
Route::get('/Summary/Files/{year}/{month}','FileManager\SummaryController@ArchiveSummaryFiles')->name('ArchiveSummaryFile.Show');
Route::get('//TodayFiles','FileManager\SummaryController@TodayFiles')->name('TodayFiles.Show');
Route::get('/LastWeekFiles','FileManager\SummaryController@LastWeekFiles')->name('LastWeekFiles.Show');
Route::post('/GivenDateFiles','FileManager\SummaryController@GivenDateFiles')->name('GivenDateFiles.Show');
Route::post('/GivenTwoDatesFiles','FileManager\SummaryController@GivenTwoDatesFiles')->name('GivenTwoDatesFiles.Show');
Route::get('/LandingPageFiles/{View}','FileManager\ViewerController@LandingPageFiles')->name('LandingPageFiles.Show');
//Summary-end

/**************** end of FileManager***************/


