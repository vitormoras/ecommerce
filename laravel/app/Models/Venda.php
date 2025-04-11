<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;
    protected $fillable = ['cliente_id', 'funcionario_id', 'total', 'data_venda'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class);
    }

    public function itens()
    {
        return $this->hasMany(ItemVenda::class);
    }
}
