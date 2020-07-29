<?php
    class M_datatables extends CI_Model implements DatatableModel{
    	
		/**
		 * @ return
		 * 		Expressions / Columns to append to the select created by the Datatable library
		 */
		public function appendToSelectStr() {
			//_protect_identifiers needs to be FALSE in the database.php when using custom expresions to avoid db errors.
			//CI is putting `` around the expression instead of just the column names
				return NULL;
		}
    	
		public function fromTableStr() {
			$tables = $this->config->item('tables','ion_auth');
			return $tables['users'].' u';
		}
    
	    /**
	     * @return
	     *     Associative array of joins.  Return NULL or empty array  when not joining
	     */
	    public function joinArray(){
	    	return NULL;
	    }
	    
    /**
     * 
     *@return
     *  Static where clause to be appended to all search queries.  Return NULL or empty array
     * when not filtering by additional criteria
     */
    	public function whereClauseArray(){
    		$where = "u.id <> 1";
			foreach($this->data['user_groups'] as $row){
				if($row['id']=="1"){
					$where = NULL;
					break;
				}
			}
    		return $where;
    	}
   }

?>