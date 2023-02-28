<?php 

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class ShoppingFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    public function date($date)
    {
        return $this->whereBetween('date', [$date, $this->input('end_date')]);
    }

    public function provider($id)
    {
        return $this->where('provider_id', $id);
    }

    public function series($series)
    {
        return $this->where('serie', $series);
    }

    public function notes($notes)
    {
        return $this->where('notes', 'LIKE', "%$notes%");
    }

    public function dueDate($date)
    {
        return $this->whereBetween('due_date', [$date, $this->input('end_due_date')]);
    }

    public function pdf($pdf)
    {
        return $this->where('pdf', 'LIKE', "%$pdf%");
    }

    public function xml($xml)
    {
        return $this->where('pdxmlf', 'LIKE', "%$xml%");
    }

    public function createdBy($id)
    {
        return $this->where('created_by_user_id', $id);
    }

    public function lastUpdatedBy($id)
    {
        return $this->where('last_updated_by_user_id', $id);
    }

    public function createdAt($date)
    {
        return $this->whereBetween('created_at', [$date, $this->input('end_created_at_date')]);
    }

    public function updatedAt($date)
    {
        return $this->whereBetween('updated_at', [$date, $this->input('end_updated_at_date')]);
    }

    public function prueba($prueba)
    {

    }

}
