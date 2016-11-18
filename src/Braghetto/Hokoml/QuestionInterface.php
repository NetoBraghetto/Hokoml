<?php
namespace Braghetto\Hokoml;

/**
* QuestionInterface
*/

interface QuestionInterface
{
    public function find($question_id);

    public function ask($product_id, $question);

    public function answer($question_id, $answer);

    public function fromProduct($product_id, array $filters = [], $sort = null);

    public function blockUser($user_id);

    public function unblockUser($user_id);

    public function blockedUsers();

    public function received(array $filters = [], $sort = null);
}
