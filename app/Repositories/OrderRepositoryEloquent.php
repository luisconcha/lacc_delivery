<?php

namespace LaccDelivery\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use LaccDelivery\Repositories\OrderRepository;
use LaccDelivery\Models\Order;
use LaccDelivery\Validators\OrderValidator;

/**
 * Class OrderRepositoryEloquent
 * @package namespace LaccDelivery\Repositories;
 */
class OrderRepositoryEloquent extends BaseRepository implements OrderRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Order::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
