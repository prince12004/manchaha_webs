<?php

class ProductModel extends CI_Model
{

    public function productDetails($product_id)
    {
        // Get main product details
        $response = $this->db->select('jwellaries.*, categories.CategoryName')
                             ->from('jwellaries')
                             ->join('categories', 'categories.CategoryID = jwellaries.category_id')
                             ->where(['jwellaries.id'=>$product_id,'jwellaries.is_deleted'=>2])
                             ->get()
                             ->row_array();
    
        // Get variants with images
        $variants = $this->db->select('jwellary_varient.*, jwellary_images.image, jwellary_images.varient as image_variant_id')
                             ->from('jwellary_varient')
                             ->join('jwellary_images', 'jwellary_varient.varient_id = jwellary_images.varient', 'left')
                             ->where('jwellary_varient.jwellary_id', $product_id)
                             ->where(['jwellary_varient.status'=>'1','jwellary_varient.is_deleted'=>2,'jwellary_images.is_deleted'=>1])
                             ->get()
                             ->result_array();
    
        // Process variants and images
        $response['variants'] = [];
        $base_url = base_url('uploads/products/'); // Base URL for images
    
        foreach ($variants as $variant) {
            $variantId = $variant['varient_id'];
            if (!isset($response['variants'][$variantId])) {
                $response['variants'][$variantId] = [
                    'varient_id'   => $variant['varient_id'],
                    'dimension'    => $variant['dimension'],
                    'color'        => $variant['color'],
                    'weight'       => $variant['weight'],
                    'stock'        => $variant['stock'],
                    'base_price'   => $variant['base_price'],
                    'sale_price'   => $variant['sale_price'],
                    'varient_sku'  => $variant['varient_sku'],
                    'status'       => $variant['status'],
                    'images'       => []
                ];
            }

            if (!empty($variant['image'])) {
                $response['variants'][$variantId]['images'][] = $base_url . $variant['image'];
            }
        }
        $response['variants'] = array_values($response['variants']);

        $response['variant_colors'] = array_unique(array_column($response['variants'], 'color'));
    
        return $response;
    }
    
    public function getimagebycolor($data)
    {
        $this->db->select('jwellary_varient.*, jwellary_images.image')
                 ->from('jwellary_varient')
                 ->join('jwellary_images', 'jwellary_varient.varient_id = jwellary_images.varient')
                 ->where([
                     'jwellary_varient.varient_id' => $data['varient_id'],
                     'jwellary_varient.jwellary_id' => $data['id'],
                     'jwellary_varient.is_deleted' => 2
                 ]);
    
        $query = $this->db->get();
        $result = $query->result_array();
    
        if (!empty($result)) {
            // Extract variant details from the first row
            $variantDetails = $result[0];
            unset($variantDetails['image']); // Remove image field from variant details
    
            // Extract all images from the result set
            $images = array_column($result, 'image');
    
            return [
                'variant' => $variantDetails,
                'images' => $images
            ];
        }
    
        return []; // Return an empty array if no results
    }
    
    
    


    public function getSearch($searchTerm, $limit, $offset)
    {
        $this->db->select('j.*, v.*, i.image AS image') // Fetch required columns
            ->from('jwellaries j')
            ->join('jwellary_varient v', 'v.jwellary_id = j.id AND v.is_deleted = 2', 'left') // Ensure only active variants are considered
            ->join('jwellary_images i', 'i.varient = v.varient_id', 'left')
            ->where(['j.is_deleted' => 2, 'j.visibility' => 'Published']) // Ensure jewelry is active and published
            ->group_start()
                ->like('j.jwellary_name', $searchTerm)
                ->or_like('j.jwellary_description', $searchTerm)
            ->group_end()
            ->group_by('j.id') // Group by jewelry ID to avoid duplicates
            ->having('COUNT(v.varient_id) > 0') // Only include jewelry with at least one active variant
            ->limit($limit, $offset); // Apply pagination
        
        $query = $this->db->get();
        return $query->result_array();
    }
    



    public function getSearchTotal($searchTerm)
    {
        $this->db
            ->select('jwellaries.id AS jwellary_id, jwellary_varient.jwellary_id AS varient_jwellary_id') // Specify unique column aliases
            ->from('jwellaries')
            ->join('jwellary_varient', 'jwellary_varient.jwellary_id = jwellaries.id AND jwellary_varient.is_deleted = 2', 'left') // Ensure active variants are considered
            ->join('jwellary_images', 'jwellary_images.varient = jwellary_varient.varient_id', 'left')
            ->where(['jwellaries.is_deleted' => 2, 'jwellaries.visibility' => 'Published']) // Ensure jewelry is active and published
            ->group_start()
                ->like('jwellaries.jwellary_name', $searchTerm)
                ->or_like('jwellaries.jwellary_description', $searchTerm)
            ->group_end()
            ->group_by('jwellaries.id') // Group by jewelry ID to avoid duplicates
            ->having('COUNT(jwellary_varient.varient_id) > 0'); // Only count jewelry with at least one active variant
        
        return $this->db->count_all_results();
    }
    
    
    
    
    
    
}

?>