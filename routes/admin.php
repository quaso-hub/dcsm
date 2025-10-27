    <?php

    use App\Http\Controllers\Admin\CategoryFoodController;
    use App\Http\Controllers\Admin\CategoryItemController;
    use App\Http\Controllers\Admin\DashboardController;
    use App\Http\Controllers\Admin\FoodController;
    use App\Http\Controllers\Admin\FoodItemController;
    use App\Http\Controllers\Admin\OrderController;
    use App\Http\Controllers\Admin\PaymentController;
    use App\Http\Controllers\Admin\UserController;
    use Illuminate\Support\Facades\Route;

    Route::middleware(['auth', 'roleOr404:admin'])->group(function () {
        Route::resource('dashboard', DashboardController::class);

        Route::resource('foods', FoodController::class);
        Route::patch('/foods/{food}/delete-image', [FoodController::class, 'deleteImage'])->name('foods.delete_image');
        Route::post('/admin/foods/default-items', [FoodController::class, 'storeDefaultItem'])->name('foods.default-items.store');
        Route::delete('/admin/foods/default-items/{id}', [FoodController::class, 'destroyDefaultItem'])->name('foods.default-items.destroy');

        Route::resource('categoriesItems', CategoryItemController::class);

        Route::resource('categoriesFoods', CategoryFoodController::class)->parameters([
            'category-food' => 'categoryFood'
        ]);

        Route::resource('food-items', FoodItemController::class);

        Route::resource('payments', PaymentController::class);

        Route::resource('orders', OrderController::class)->only(['index', 'show', 'update']);

        Route::resource('/users', UserController::class);
    });
