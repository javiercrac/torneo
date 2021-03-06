<?php
namespace torneo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Torneo extends Model{

    use SoftDeletes;

    protected $table='torneos';

    protected $fillable = ['nombre_torneo','observaciones_torneo','idtipo_torneo','fecha_baja'];

    protected $primaryKey = 'idtorneo';

    public function TipoTorneo()
    {
        return $this->hasOne('torneo\TipoTorneo', 'idtipo_torneo','idtipo_torneo');
    }
    public function ListEquipos()
    {
        return $this->belongsToMany('torneo\Equipo','torneo_equipo','torneo_idtorneo','equipo_idequipo');
    }
    public function ListFechas()
    {
        return $this->hasMany('torneo\Fecha','idtorneo','idtorneo');
    }


    //Propiedades Sin mapeo
    private  $activo;
    /**
     * @return Solo Lectura
     */
    public function Activo()
    {
        if($this->deleted_at ==null)
        {
            return true;
        }
        else
        {
            return false;
        }
    }


}