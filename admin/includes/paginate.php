<?php 
/**
* 
*/
class Paginate
{
	public $current_page;
	public $items_per_page;
	public $items_total_count;

	public function __construct($current_page = 1, $items_per_page=4, $items_total_count){

			$this->current_page = $current_page;
			$this->items_per_page = $items_per_page;
			$this->items_total_count = $items_total_count;
	}

	public function next(){

		return $this->current_page + 1;
	}


	public function previous(){

		return $this->current_page -1;
	}

	public function page_total(){

		return ceil($this->items_total_count / $this->items_per_page);
	}

	public function has_previous(){

		return $this->previous()>=1 ? true : false ;
	}

	public function has_next(){

		return $this->next() <= $this->page_total() ? true : false;
	}

	public function offset(){

		return ($this->current_page-1) * $this->items_per_page;
	}
}
 ?>