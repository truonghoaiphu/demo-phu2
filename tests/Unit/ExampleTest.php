<?php

namespace Tests\Unit;

use App\Models\ShareVideo;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_that_true_is_true()
    {
        $this->assertTrue(true);
    }

    public function test_it_belongs_to_user()
    {
        $this->assertBelongsTo(User::class, 'user_id', 'id', new ShareVideo, 'user');
    }


    protected function assertBelongsTo($related, $model, $relationName)
    {
        $relation = $model->$relationName();

        $this->assertInstanceOf(BelongsTo::class, $relation, 'Relation is wrong');
        $this->assertInstanceOf($related, $relation->getRelated(), 'Related model is wrong');
    }
}
