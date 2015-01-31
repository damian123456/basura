<?
class Pager {
	var $total=null;
	var $max_per_page=null;
	var $new_sql=null;
	var $page=null;
	var $page_count=null;
	var $items_offset=null;
	var $offset=null;
	var $link_template=null;


/*
 * Public Functions
 */

	public function __construct($sql, $page, $max_per_page, $link, $count_sql=null){
		global $db;

		$max_per_page = max($max_per_page, 1);

		if(is_string($count_sql)){
			$cant = $db->fetch_item_field($count_sql);
		} elseif(is_numeric($count_sql)){
			$cant = (int)$count_sql;
		} else {
			if($res = $db->query($sql))
				$cant = $db->num_rows($res);
		}

		$pages = ceil($cant/$max_per_page);
		if($page === 'last')
			$page = $pages;
		$page = max(1,$page);
		$offset = ($page - 1) * $max_per_page;

		$limit = " LIMIT $offset,$max_per_page";
		$this->new_sql = $sql.$limit;
		$this->total = $cant;
		$this->max_per_page = $max_per_page;
		$this->page = $page;
		$this->page_count = $pages;
		$this->offset = $offset;
		$this->link_template = $link;
	}

	public function total() {
		return $this->total;
	}

	public function page_count() {
		return $this->page_count;
	}

	public function page(){
		return $this->page;
	}

	public function result() {
		return $this->new_sql;
	}

	public function max_per_page() {
		return $this->max_per_page;
	}


/*
 * Prints pager controls like this:
 *    << ANTERIOR   1 2 3 4 5 6 7   SIGUIENTE >>
 */
	public function controls($number_limit=5, $class="paginador", $desc = null){
		$page = $this->page;
		$paginas = $this->page_count;
		$start = max($page - floor($number_limit/2),1);
		$end = $start - 1 + min($paginas,$number_limit);
		if($end > $paginas){
			$start = max($paginas - $number_limit + 1,1);
			$end = $start -1 + min($paginas,$number_limit);
		}
		$link = $this->link_template;
		$ret = '';
		if($paginas >1){
			if ($page != 1)
				$ret.= '<div class="flecha"><a href="'.$this->replace_template($link,$page-1).'">&lsaquo;</a></div>';

			if($start > 1) $ret.= '<div class="numero">... </div>';

			for ($i=$start; $i <= $end; $i++){
				if ($page!=$i)
					if($i==$start && $first_link)
						$ret.='<div class="numero"><a href="'.$this->replace_template($first_link,$i).'">'.$i.'</a></div>';
					else
						$ret.='<div class="numero"><a href="'.$this->replace_template($link,$i).'">'.$i.'</a></div>';
				else
					$ret.='<div class="numero"><a href="'.$this->replace_template($link,$i).'" class="actual">'.$i.'</a></div>';
				if($i < $end) $ret.= "";
			}

			if($end < $paginas) $ret.= '<div class="numero"> ...</div>';

			if ($page != $paginas)
				$ret.='<div class="flecha"><a href="'.$this->replace_template($link,$page+1).'">&rsaquo;</a></div>';
		}
		return $ret;
	}

	public function controlsArray(){
		$arr = array();
		$page = $this->page;
		$paginas = $this->page_count;
		$link = $this->link_template;
		$arr['page_count'] = $paginas;
		$arr['current'] = $page;
		$arr['pages'] = array();
		if($paginas >1){
			if ($page != 1){
				$arr['first'] = $this->replace_template($link,1);
				$arr['previous'] = $this->replace_template($link,$page-1);
			}

			for ($i=1; $i <= $paginas; $i++){
				$arr['pages'][$i] = $this->replace_template($link,$i);
			}

			if ($page != $paginas){
				$arr['next'] = $this->replace_template($link,$page+1);
				$arr['last'] = $this->replace_template($link,$paginas);
			}
		}
		return $arr;
	}

/*
 * Private Functions
 */

	public function replace_template($str,$page){
		$offset = ($page - 1) * $this->max_per_page;
		$search_replace = array(
					"__page__"=>$page,
					"__offset__"=>$offset,
					"__pages__"=>$this->page_count,
					"__total__"=>$this->total,
					"__max_per_page__"=>$this->max_per_page
					);
		$search = array_keys($search_replace);
		$replace = array_values($search_replace);
		return str_replace($search, $replace, $str);
	}
}

// Pager extender.
// Use to change the controls returned
class SimplePager extends Pager{
	public function simpleControls($first_link=null,$class = 'pager_link'){
		$page = $this->page;
		$paginas = $this->page_count;

		$link = $this->link_template;
		$ret = '<ul class="'.$class.'">';
		if($paginas > 1){
			if ($page != 1)
				$ret.= '<a href="'.$this->replace_template($link,$page-1).'" class="'.$class.'">Anterior</a>';

			if ($page != $paginas)
				$ret.='<a href="'.$this->replace_template($link,$page+1).'" class="'.$class.'">Siguiente</a>';
		}
		$ret.= '</ul>';
		return $ret;
	}
}

// Pager extender.
// Use to change the controls returned
class ImagePager extends Pager{
	public function imageControls($number_limit=5, $class="pager_link"){
		$page = $this->page;
		$paginas = $this->page_count;
		$start = max($page - floor($number_limit/2),1);
		$end = $start - 1 + min($paginas,$number_limit);
		if($end > $paginas){
			$start = max($paginas - $number_limit + 1,1);
			$end = $start -1 + min($paginas,$number_limit);
		}
		$link = $this->link_template;
		$ret = '';
		if($paginas >1){
			if ($page != 1){
				$ret.= '<a href="'.$this->replace_template($link,1).'"><img src="'.__("##IMG_PAGER_FIRST##").'" title="'.__("##NG_FIRST##").'" alt="'.__("##NG_FIRST##").'" width="16" height="16"></a>';
				$ret.= '<a href="'.$this->replace_template($link,$page-1).'"><img src="'.__("##IMG_PAGER_PREVIOUS##").'" title="'.__("##NG_PREVIOUS##").'" alt="'.__("##NG_PREVIOUS##").'" width="16" height="16"></a>';
			}

			if($start > 1) $ret.= "... ";

			for ($i=$start; $i <= $end; $i++){
				if ($page!=$i)
					$ret.='<a href="'.$this->replace_template($link,$i).'" class="'.$class.'">'.$i.'</a>';
				else
					$ret.='<a href="'.$this->replace_template($link,$i).'" class="'.$class.' current">'.$i.'</a>';
				if($i < $end) $ret.= "";
			}

			if($end < $paginas) $ret.= " ...";

			if ($page != $paginas){
				$ret.='<a href="'.$this->replace_template($link,$page+1).'"><img src="'.__("##IMG_PAGER_NEXT##").'" title="'.__("##NG_NEXT##").'" alt="'.__("##NG_NEXT##").'" width="16" height="16"></a>';
				$ret.='<a href="'.$this->replace_template($link,$this->page_count).'"><img src="'.__("##IMG_PAGER_LAST##").'" title="'.__("##NG_LAST##").'" alt="'.__("##NG_LAST##").'" width="16" height="16"></a>';
			}
		}
		return $ret;
	}
}
