<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ColorRoute;


class Route extends Model
{

    protected $primaryKey = 'id_route';
    protected $fillable = ['id_sector', 'color_route', 'difficulty_route', 'url_photo', 'updated_at'];

    public function room () {
        return $this->belongsTo('App\Room');
    }

    public function byRoomAndType(int $id_room, string $type, array $routeExtraParameters = []) {
    	$request = Route::select('routes.*')
                ->join('sectors', 'routes.id_sector', '=', 'sectors.id_sector')
                ->where([
                    ['sectors.climbing_type', $type],
                    ['sectors.id_room', $id_room]
                ]);
    	foreach ($routeExtraParameters as $name => $value) {

    	    if($name === 'id_color' && $value !== null) {
    	        $color = ColorRoute::where('name_color',$value)->get('id_color')->first();
    	        $value = $color->id_color;
            }
    	    if ($value) {
                $request->where($name, '=', $value);
            }
        }

    	return $request->get();
    }

    public function byRoomAndSector(int $id_room, int $id_sector) {
    	return Route::select('routes.*')
    			->join('sectors', 'routes.id_sector', '=', 'sectors.id_sector')
    			->where([
    				['sectors.id_sector', $id_sector],
    				['sectors.id_room', $id_room]
    			])
    			->get();
    }
}
