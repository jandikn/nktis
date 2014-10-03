<?php

namespace App;
use Nette;


/**
 * Post Model.
 */
class PostModel extends Model
{

    public function getPosts() {
		return $this->db->table('post');
    }
}
