<?php
class Post_model extends CI_Model{
    public function getUserPostsPagination($userId, $limit = NULL, $start = NULL)
    {
        $this->db->limit($limit, $start);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get_where('posts', array('user_id' => $userId));
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $data[] = $row;
            }

            return $data;
        }
        return false;
    }
    public function getUserPosts($userId)
    {
        $query = $this->db->get_where('posts', array('user_id' => $userId));
        return $query;
    }
    public function getAllPostsPagination($limit, $start)
    {
        $this->db->limit($limit, $start);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('posts');
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $data[] = $row;
            }

            return $data;
        }
    }
    public function getAllPosts()
    {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('posts');
        return $query;
    }
    public function getPost($id)
    {
        $query = $this->db->get_where('posts', array('id' => $id));
        return $query;
    }
    public function getImages($id)
    {
        $query = $this->db->get_where('photos', array('post_id' => $id));
        return $query;
    }
    public function createPost()
    {
        $save = array(
            'title'         => $this->input->post('title'),
            'description'   => $this->input->post('description'),
            'user_id'       => $this->session->userdata('user_id')
        );
        $this->db->insert('posts', $save);
        $postId = $this->db->insert_id();
        return $postId;
    }
    public function deleteImage($id)
    {
        $photo = $this->db->get_where('photos', array('id' => $id));
        $name = $photo->result_array()[0]['name'];
        $post_id = $photo->result_array()[0]['post_id'];
        $data['name'] = $name;
        $data['post_id'] = $post_id;
        $query = $this->db->delete('photos', array('id' => $id));
        return $data;
    }
    public function updatePost($id)
    {
        $data = array(
            'title' => $this->input->post('title'),
            'description'  => $this->input->post('description')
        );
        $this->db->where('id', $id);
        $this->db->update('posts', $data);
    }
    public function deletePost($id)
    {
        $this->db->delete('posts', array('id' => $id));
        $photos = $this->db->get_where('photos', array('post_id' => $id));
        foreach($photos->result_array() as $photo){
            $data[] = $photo['name'];
        }
        $this->db->delete('photos', array('post_id' => $id));
        return $data;
    }
}