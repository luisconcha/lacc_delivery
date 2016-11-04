<?php

namespace LaccDelivery\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use LaccDelivery\Models\OrderItem;

/**
 * Class OrderItemRepositoryEloquent
 * @package namespace LaccDelivery\Repositories;
 */
class OrderItemRepositoryEloquent extends BaseRepository implements OrderItemRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return OrderItem::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
