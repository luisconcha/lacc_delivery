<?php

namespace LaccDelivery\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use LaccDelivery\Repositories\CupomRepository;
use LaccDelivery\Models\Cupom;
use LaccDelivery\Validators\CupomValidator;

/**
 * Class CupomRepositoryEloquent
 * @package namespace LaccDelivery\Repositories;
 */
class CupomRepositoryEloquent extends BaseRepository implements CupomRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Cupom::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
