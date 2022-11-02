<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\swaggerController;
use App\Http\Controllers\usersController;
use App\Http\Controllers\userController;
use App\Http\Controllers\hotelsController;
use App\Http\Controllers\transfer_suplierid_transferidController;
use App\Http\Controllers\ideasController;
use App\Http\Controllers\flightController;
use App\Http\Controllers\transport_supplieridController;
use App\Http\Controllers\transport_supplierid_transportidController;
use App\Http\Controllers\Transport_supplierid_transportid_optioncodeController;
use App\Http\Controllers\hotel_supplierid_providercodeController;
use App\Http\Controllers\accommodationsController;
use App\Http\Controllers\accommodations_allController;
use App\Http\Controllers\agenciesController;
use App\Http\Controllers\Agancy_idController;
use App\Http\Controllers\AgencyCreditController;
use App\Http\Controllers\usersbyAgencyController;
use App\Http\Controllers\allUsersController;
use App\Http\Controllers\golfbySupplierController;
use App\Http\Controllers\supplierController;
use App\Http\Controllers\supplieridController;
use App\Http\Controllers\transfer_suplieridController;
use App\Http\Controllers\ticketSupplieridController;
use App\Http\Controllers\ticket_supplierid_ticketcodeController;
use App\Http\Controllers\airlineController;
use App\Http\Controllers\countriesController;
use App\Http\Controllers\destinationController;
use App\Http\Controllers\destinationallController;
use App\Http\Controllers\mealplanController;
use App\Http\Controllers\PromotionCodeController;
use App\Http\Controllers\themeController;
use App\Http\Controllers\preferredTicketController;
use App\Http\Controllers\package__allController;
use App\Http\Controllers\package__holidayPackageController;
use App\Http\Controllers\package__holidayPackage_idController;
use App\Http\Controllers\travelidea_ideaid_lan_currencyController;
use App\Http\Controllers\travelidea_idea_languageController;
use App\Http\Controllers\tripIdeasController;
use App\Http\Controllers\tripIdeas_idController;
use App\Http\Controllers\delete__TripIdeasCategoriesController;
use App\Http\Controllers\get__all__destinationController;
use App\Http\Controllers\randomController;
use App\Http\Controllers\getBooking_allController;
use App\Http\Controllers\getBooking_refController;
use App\Http\Controllers\closedTour;
use App\Http\Controllers\closedTour_optionCode;
use App\Http\Controllers\CP_CLOUD_DB;
use App\Http\Controllers\agencyAllController;
use App\Http\Controllers\agencyManager;
use App\Http\Controllers\transportBase;
use App\Http\Controllers\LogForm;
use App\Http\Controllers\ExcelCSVController;
use App\Http\Controllers\updateuserController;
use App\Http\Controllers\createTripIdasController;
use App\Http\Controllers\createuserController;
use App\Http\Controllers\updateTripIdeasController;

Route::get('/', function () {return view('welcome');});
Route::get('/get__user/{username}/{password}', [usersController::class, 'index']);
Route::get('/get__user_id/{username}/{accessToken?}', [userController::class, 'index']);
Route::get('/get__hotel/{supplierid}', [hotelsController::class, 'index']);
Route::get('/get__transfer/{supplierid}', [transfer_suplieridController::class, 'index']);
Route::get('/get__transfer_supplierid_transferid/{supplierid}/{transferid}', [transfer_suplierid_transferidController::class, 'index']);
Route::get('/get__ideas/{language}/{currency}/{country?}', [ideasController::class, 'index']);
Route::get('/get__csrf', [createuserController::class, 'GET__CSRF']);
Route::get('/get__flight', [flightController::class, 'index']);
Route::get('/get__transport/{supplierid}', [transport_supplieridController::class, 'index']);
Route::get('/get__transport_id/{supplierid}/{transportid}', [transport_supplierid_transportidController::class, 'index']);
Route::get('/get__transport_supplier_option_Code/{supplierid}/{transportid}/{optioncode}', [Transport_supplierid_transportid_optioncodeController::class, 'index']);
Route::get('/get__hotel_supplierid_provider_code/{supplierid}/{providercode}', [hotel_supplierid_providercodeController::class, 'index']);
Route::get('/get__accommodations__all', [accommodations_allController::class, 'index']);
Route::get('/get__accommodations__by__id/{accommodationId}', [accommodationsController::class, 'index']);
Route::get('/get__airline__all', [airlineController::class, 'index']);
Route::get('/get__countries__all', [countriesController::class, 'index']);
Route::get('/get__destination__all', [get__all__destinationController::class, 'index']);
Route::get('/get__destination__by_code/{code}', [destinationallController::class, 'index']);
Route::get('/get__destination/{city}', [destinationController::class, 'index']);
Route::get('/get__package__all/{origin?}/{month?}/{destinations?}/{lang?}/{currency?}/{countryCode?}/{onlyVisible?}/{fromCreationDate?}/{toCreationDate?}/{first?}/{limit?}/{provider?}', [package__allController::class, 'index']);
Route::get('/swagger', [swaggerController::class, 'index']);
Route::get('/get__agencies__all', [agenciesController::class, 'index']);
Route::get('/get__agencies__id', [Agancy_idController::class, 'index']);
Route::get('/get__agencyCredit/{agency}', [AgencyCreditController::class, 'index']);
Route::get('/get_ agencyManager/{agencyManagerID}', [agencyManager::class, 'index']);
Route::get('/get__usersbyAgency', [usersbyAgencyController::class, 'index']);
Route::get('/get__alluser', [allUsersController::class, 'index']);
Route::get('/get__golfbySupplier/{supplierid}', [golfbySupplierController::class, 'index']);
Route::get('/supplier', [supplierController::class, 'index']);
Route::get('/supplierid/{supplierid}', [supplieridController::class, 'index']);
Route::get('/get__ticket_supplierid/{supplierid}', [ticketSupplieridController::class, 'index']);
Route::get('/get__ticket/{supplierid}/{ticketcode}', [ticket_supplierid_ticketcodeController::class, 'index']);
Route::get('/get__mealplan', [mealplanController::class, 'index']);
Route::get('/get__promotioncode', [PromotionCodeController::class, 'index']);
Route::get('/get__theme', [themeController::class, 'index']);
Route::get('/get__preferredticket', [preferredTicketController::class, 'index']);
Route::get('/get__package__holidayPackage_id_CURRENCY/{holidayPackageId}/{currency?}', [package__holidayPackageController::class, 'index']);
Route::get('/get__package__holidayPackage_id_LAN_CURRENCY/{holidayPackageId}', [package__holidayPackage_idController::class, 'index']);
Route::get('/get__travelidea_ideaid_lan_currency/{idea}', [travelidea_ideaid_lan_currencyController::class, 'index']);
Route::get('/get__travelidea_idea_language/{idea}', [travelidea_idea_languageController::class, 'index']);
Route::get('/get__TripIdeasCategories__by__name/{city}', [tripIdeasController::class, 'index']);
Route::get('/get__TripIdeasCategories__by__id/{id}', [tripIdeas_idController::class, 'index']);
Route::get('/delete__TripIdeasCategories/{HotelId}', [delete__TripIdeasCategoriesController::class, 'index']);
Route::get('/get__TripIdeasCategoriesHotelten__by__name/{city}', [randomController::class, 'index']);
Route::get('/get__Booking_all/{from}/{to}/{lang?}', [getBooking_allController::class, 'index']);
Route::get('/get__Booking_ref/{ref}', [getBooking_refController::class, 'index']);
Route::get('/get_Closed_Tour/{suplierid}/{closertourcode}', [closedTour::class, 'index']);
Route::get('/get_closedTour_optionCode/{suplierid}/{closertourcode}/{optionCode}', [closedTour_optionCode::class, 'index']);
Route::get('/create_user_copy', [CP_CLOUD_DB::class, 'index']);
Route::get('/get_allAgency', [agencyAllController::class, 'index']);
Route::get('/get_transportBase', [transportBase::class, 'index']);
Route::get('/filterbyday', [LogForm::class, 'filterbyday'])->name('filterbyday');
Route::get('/logList', [LogForm::class, 'LogList'])->name('logList');
Route::get('/log/{id?}', [LogForm::class, 'LoginForm'])->name('log');
Route::get('/downloadResponse/{id}', [LogForm::class, 'downloadResponse'])->name('downloadResponse');


Route::post('checkLog', [LogForm::class, 'checkLog'])->name('checklog');
Route::post('/csv-gen', [ExcelCSVController::class, 'export'])->name('export');
Route::post('/create__user', [createuserController::class, 'index']);
Route::post('/update__user', [updateuserController::class, 'index']);
Route::post('/create__TripIdeasCategories', [createTripIdasController::class, 'index']);
Route::put('/update__TripIdeasCategories', [updateTripIdeasController::class, 'index']);