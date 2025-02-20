<?php
class CategoryModel extends CI_Model{
    public function getCategories()
    {
        $query = $this->db->get('categories');
        return $query->result();
    }

    public function getDataCategories($categoryID, $limit, $offset)
    {
        $response = $this->db->select('jwellaries.*, MIN(jwellary_images.image) as image,jwellary_varient.*')
            ->from('jwellaries')
            ->join('jwellary_varient', 'jwellaries.id = jwellary_varient.jwellary_id AND jwellary_varient.is_deleted = 2')
            ->join('jwellary_images', 'jwellary_varient.varient_id = jwellary_images.varient', 'left')
            ->where(['jwellaries.is_deleted' => 2, 'jwellaries.visibility' => 'Published'])
            ->group_start()
                ->where('jwellaries.category_id', $categoryID)
                ->or_where('jwellaries.subcategory_id', $categoryID)
            ->group_end()
            ->group_by('jwellaries.id')
            ->having('COUNT(jwellary_varient.varient_id) > 0')
            ->order_by('jwellaries.created_at', 'DESC')
            ->limit($limit, $offset)
            ->get()
            ->result_array();
    
        if (empty($response)) {
            $data = $this->getCategoriesById($categoryID); // Fetch parent category data if no results
            if (!empty($data['ParentCategoryID'])) {
                $response = $this->getDataCategories($data['ParentCategoryID'], $limit, $offset);
            }
        }
    
        return $response;
    }
    
    
    


    public function countCategories($categoryID)
    {
        $this->db->select('j.id')
            ->from('jwellaries j')
            ->join('jwellary_varient v', 'v.jwellary_id = j.id AND v.is_deleted = 2', 'inner') 
            ->where(['j.is_deleted' => 2, 'j.visibility' => 'Published'])
            ->group_start()
                ->where('j.category_id', $categoryID)
                ->or_where('j.subcategory_id', $categoryID)
            ->group_end()
            ->group_by('j.id');
        return $this->db->count_all_results();
    }
    
    
    
public function getCategoriesById($categoryID)
{
    return $this->db->select('categories.*')
        ->from('categories')
        ->where(['categories.CategoryID'=>$categoryID,'categories.IsActive'=>1,'categories.is_deleted'=>1])
        ->get()->row_array();
    //  $this->db->count_all_results();
}
    
	
	
    public function saveCategory($data)
    {
        $sql = "INSERT INTO categories (categoryName, child_category_id, IsActive, CategoryDescription, categoryImage)
        VALUES (?, ?, ?, ?, ?)";
    $this->db->query($sql, [
    $data['category_name'],
    $data['subcategory_id'],
    $data['category_status'],
    $data['category_description'],
    $data['category_image']
    ]);
  }
}
?>