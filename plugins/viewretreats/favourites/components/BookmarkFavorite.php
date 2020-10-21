<?php namespace Viewretreats\Favourites\Components;

use Cms\Classes\ComponentBase;
use Viewretreats\Favourites\Models\Favourite;
use Request;
use Session;
class BookmarkFavorite extends ComponentBase
{
	public function componentDetails(){
		return [
			'name' => 'Bookmark Favorite',
			'description' => 'Adding bookmarks'
		];
	}

	public function onUserBookmark(){
		if (Request::ajax()) {
			$data = post();
			$user_id = $data['user_id'];
			$product_id = $data['product_id'];
			$bookmarked = Favourite::where('user_id', '=' , $user_id)
                                ->where('product_id', '=' , $product_id)->count();


	        if($bookmarked){
	            $bookmarked_product = Favourite::where('user_id', '=' , $user_id)
                              ->where('product_id', '=' , $product_id);
	            $bookmarked_product->delete();
	            $data = [
	                'message' => 'Bookmark deleted',
	                'status' => 'deleted'
	            ];
	            return $data;
	        }else{
	        	$bookmark = new Favourite();
	        	$bookmark->user_id = $user_id;
	        	$bookmark->product_id = $product_id;
	            $bookmark->save();

	            $data = [
	                'message' => 'Bookmark Added',
	                'status' => 'added'
	            ];
	            return $data;
	        }
	    }
	}

		public function onGuestBookmark(){
			if (Request::ajax()) {
				$data = post();
				$product_id = $data['product_id'];
				$message = 'bookmark not found';
				$saved_favourites = Session::get('guestFavourites', function() { return 'Not found'; });
					if ($saved_favourites != 'Not found') {
						foreach ($saved_favourites as $key => $data) {
							if ($data == $product_id) {
								$message = 'bookmark found';
								break;
							}
						}
						if ($message == 'bookmark found') {
							$key = array_search($product_id, $saved_favourites);
							if (false !== $key) {
							    unset($saved_favourites[$key]);
									$new_favourites = $saved_favourites;
									$value = Session::pull('guestFavourites', 'default');
									foreach ($new_favourites as $key => $value) {
										Session::push('guestFavourites', $value);
									}
									$data = [
			                'message' => 'Bookmark deleted',
			                'status' => 'deleted'
			            ];
			            return $data;
							}
						}
						else if ($message == 'bookmark not found') {
							Session::push('guestFavourites', $product_id);
							$data = [
	                'message' => 'Bookmark Added',
	                'status' => 'added'
	            ];
	            return $data;
						}
					}
					else{
						Session::push('guestFavourites', $product_id);
						$data = [
								'message' => 'Bookmark Added',
								'status' => 'added'
						];
						return $data;
					}
		    }
		}
}
