<?php

namespace App\Http\Controllers;

use Illuminate\Http\{ Request, JsonResponse };

class UploadController extends Controller
{
	/**
	 * Single image file upload
	 *
	 * @param  \Illuminate\Http\Request
	 * @return \Illuminate\Http\JsonResponse
	 *
	 * @todo   Make use of Request, Storage, Validator ?
	 */
	public function single_image(Request $request): JsonResponse
	{
		$dirname = storage_path('app/uploads').'/';
		$response = [];

		if (!empty($_FILES['file'])) {

			/** Authorized file mime types / extensions */
			/** Must be identical as in uppy.js */
			$extensions = [
				'image/jpeg' => '.jpg',
				// 'image/webp' => '.webp',
				'image/png' => '.png',
				'image/gif' => '.gif',
			];

			if (!empty($_FILES['file']['type']) && !empty($extensions[$_FILES['file']['type']])) {
				$filename = (empty($_REQUEST['filename'])) ? $_FILES['file']['name'] : $_REQUEST['filename'].$extensions[$_FILES['file']['type']];
				// $filename = (empty($_REQUEST['filename'])) ? $_FILES['file']['name'] : $_REQUEST['filename'];
				if (move_uploaded_file($_FILES['file']['tmp_name'], $dirname.$filename)) {
					$response = [
						'status' => 200,
						'body' => 'File "'.$dirname.$filename.'" correctly uploaded',
						'uploadURL' => $filename,
						'message' => 'success',
					];
				} else {
					$response = [
						'status' => 0,
						'body' => 'Could not save file "'.$dirname.$filename.'"',
						'message' => 'error',
					];
				}
			} else {
				$response = [
					'status' => 0,
					'body' => 'Invalid file type',
					'message' => 'error',
				];
			}

		// } else {
		//     return redirect(route('home'), 303);

		}

		return response()->json($response);
	}

	// /**
	//  * Multiple image file upload
	//  *
	//  * @param  \Illuminate\Http\Request
	//  * @return \Illuminate\Http\JsonResponse
	//  */
	// public function multiple_images(Request $request): JsonResponse
	// {
	//     if (!empty($_FILES['files'])) {
	//         $error = false;
	//         $response_body = [];
	//         foreach ($_FILES['files']['name'] as $k => $filename) {
	//         if (move_uploaded_file($_FILES['files']['tmp_name'][$k], $dirname.$filename)) {
	//                 $response_body[$k] = 'File "'.$dirname.$filename.'" correctly uploaded';
	//             } else {
	//                 $error = true;
	//                 $response_body[$k] = 'Could not save file "'.$dirname.$filename.'"';
	//             }
	//         }
	//         $response = [
	//             'status' => $error ? 0 : 200,
	//             'body' => $response_body,
	//         ];
	//     }
	// }
}
