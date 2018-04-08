<?php

namespace LSAPI\Repositories;

use League\Fractal\Manager;
use League\Fractal\Serializer\JsonApiSerializer;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use LSAPI\Entities\LSTelefones;

/**
 * Class LSTelefonesRepositoryEloquent
 * @package namespace LSAPI\Repositories;
 */
class LSTelefonesRepositoryEloquent extends BaseRepository implements LSTelefonesRepository {

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model() {
        return LSTelefones::class;
    }

    public function search($search_field) {
        $manager = new Manager();
        $manager->setSerializer(new JsonApiSerializer());

        $result = LSTelefones::where(function ($query) use ($search_field) {
                    $query->where('telefone', 'ilike', "%$search_field%");
                    $query->whereNull('disabled_at');
                })
                ->paginate(24);
        return $this->parserResult($result);
    }

    public function searchTelefone($search_field) {
        $manager = new Manager();
        $manager->setSerializer(new JsonApiSerializer());

        $result = LSTelefones::where(function ($query) use ($search_field) {
                    $query->where('id', '=', $search_field);
                    $query->whereNull('disabled_at');
                })
                ->paginate(24);
        return $this->parserResult($result);
    }

    public function searchTelefones($data) {
        if (isset($data['ls_clientes_id'])) {
            $manager = new Manager();
            $manager->setSerializer(new JsonApiSerializer());

            $result = LSTelefones::where(function ($query) use ($data) {
                        $query->where('ls_clientes_id', '=', $data['ls_clientes_id']);
                        $query->where('telefone', '=', $data['telefone']);
                        $query->whereNull('disabled_at');
                    })
                    ->paginate(24);
            return $this->parserResult($result);
        } else {
            return false;
        }
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot() {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
