<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['image', 'tour_id'];

    public function listGallery($tour_id)
    {
        return $this->where('tour_id', $tour_id)->get();
    }

    public function storeData($request)
    {
        $params = $request->only(['tour_id']);
        if ($request->has('images')) {
            foreach ($request->file('images') as $key => $image) {
                $imageName = (time() + $key) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('upload/tour/gallery'), $imageName);
                $imageNames[] = $imageName;
                $params['image'] = $imageName;
                $this->create($params);
            }
            return redirect()->route('tour.gallery', ['id' => $params['tour_id']])->with(['alert-type' => 'success', 'message' => 'Store data successfull']);
        }
        return redirect()->route('tour.gallery', ['id' => $params['tour_id']])->with(['alert-type' => 'error', 'message' => 'Store data fail']);
    }

    public function deleteImageInGallery($id)
    {
        $image = $this->find($id);
            $filePathName = 'upload/tour/gallery/'.$image->image;
        if (file_exists($filePathName)) {
            unlink($filePathName);
        }
        $image->delete();
        return $id;
    }
}
