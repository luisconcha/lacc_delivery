<?php

namespace LaccDelivery\Presenters;

use LaccDelivery\Transformers\CupomTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class CupomPresenter
 *
 * @package namespace LaccDelivery\Presenters;
 */
class CupomPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new CupomTransformer();
    }
}
