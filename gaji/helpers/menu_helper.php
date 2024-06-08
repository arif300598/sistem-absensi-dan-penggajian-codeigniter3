<?php

    function _get_menu($id_parent,$tipe)
    {
        $CI =& get_instance();
        
        $rm = $CI->session->userdata('granted_menu');
        
        $granted_menu = explode(',',$rm);
        
        $data = array();
        $CI->db->from('menu');
        $CI->db->where('id_parent',$id_parent);
        if($tipe === 'selected'){
            $CI->db->where_in('id',$granted_menu);    
        }
        
        $CI->db->order_by('id','ASC');
        $result = $CI->db->get();
        
        foreach($result->result() as $row)
        {
            $data[] = array(
                'id_parent' =>  $row->id_parent,
                'id'        =>  $row->id,
                'web_title' =>  $row->web_title,
                'title'     =>  $row->title,
                'icon'      =>  $row->icon,
                'href'      =>  $row->href,
                'has_sub'   =>  $row->has_sub,
                'child'     =>  _get_menu($row->id,$tipe)
            );
          
        }
        
        return $data;
        
    }
/********************************************************************************************/
    function _print_submenu($data_menu,$tipe = 'left-side-menu')
    {
        $str = "";
        $result = "";
        //$str .= '<ul class="sub">' . PHP_EOL;
        foreach($data_menu as $data)
        {
            if($tipe === 'left-side-menu'){
                
                $str .= '   <li id="' . $data['id'] . '"><a web_title="' . $data['web_title'] .'" href="#" link="' . base_url() . $data['href'] .'">' . $data['title'] .'</a></li>' . PHP_EOL; 
                
            }else{
                
                $str .= '<li><input type="checkbox" kode="' . $data['id'] . '" id="cb_' . $data['id']. '"><label>' . $data['title'] . '</label>' . PHP_EOL;
                
            }
            
            $str .= _print_submenu($data['child'],$tipe);    
            
        }
        //$str .= '</ul>' . PHP_EOL;
        if($tipe === 'left-side-menu'){
            $result .= '<ul class="sub">' . PHP_EOL . $str .  '</ul>' . PHP_EOL ;
        }else{
            $result .= $str . PHP_EOL;
        }
        
        return $result;
    }
    
    function build_menu($tipe = 'left-side-menu')
    {
        $CI =& get_instance();
        
        $menu_item  = _get_menu(0,($tipe ==='left-side-menu' ? 'selected':'all'));
        
        $menu = "";
        foreach($menu_item as $r)
        {
            if($tipe === 'left-side-menu'){
                if($r['has_sub'] === 'N')
                {
                    $menu .= '<li id="' . $r['id'] . '">' . PHP_EOL;
                    $menu .= '  <a web_title="' . $r['web_title'] .'" href="#" link="' . base_url() . $r['href']. '">' . PHP_EOL;
                    $menu .= '    <i class="' . $r['icon'] .'"></i>' . PHP_EOL;
                    $menu .= '    <span>' . $r['title'] . '</span>' . PHP_EOL;
                    $menu .= '  </a>' . PHP_EOL;
                    $menu .= '</li>' . PHP_EOL;
                    
                }else
                {
                    $menu .= ' <li id="' . $r['id'] . '" class="sub-menu">' . PHP_EOL;
                    $menu .= '  <a web_title="' . $r['web_title'] .'" href="#" link="javascript:;">' . PHP_EOL;
                    $menu .= '    <i class="' . $r['icon'] .'"></i>' . PHP_EOL;
                    $menu .= '    <span>' . $r['title'] . '</span>' . PHP_EOL;
                    $menu .= '  </a>' . PHP_EOL;
                    $menu .= _print_submenu($r['child'],$tipe);
                    $menu .= '</li>' . PHP_EOL;
                }
            }else{
                
                if($r['has_sub'] === 'N')
                {
                    $menu .= '<li><input type="checkbox" kode="' . $r['id'] . '" id="cb_' . $r['id']. '"><label>' . $r['title'] . '</label>' . PHP_EOL;
                    
                }else{
                    
                    $menu .= '<li><input type="checkbox" kode="' . $r['id'] . '" id="cb_' . $r['id']. '"><label>' . $r['title'] . '</label>' . PHP_EOL;
                    $menu .= '<ul>';
                    $menu .= _print_submenu($r['child'],$tipe);
                    $menu .= '</ul>';    
                }
            }
            
        }
        
        return $menu;
                
    }
    
/********************************************************************************************/    