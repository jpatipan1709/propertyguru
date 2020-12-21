<?php


if (!function_exists('TestAdmin')) {
    function TestAdmin()
    {
       return '<a>test</a>';
    }
}



if (!function_exists('unsetAdmin')) {
    function unsetAdmin()
    {
        Session::forget('id_admin');
        Session::forget('name_admin');
        Session::forget('lastname_admin');
        Session::forget('status_admin');
        Session::forget('main_id_at');
        Session::forget('email_admin');
        Session::forget('file_img_admin');
        Session::forget('username_admin');
    }
}

if (!function_exists('left_sub_menu')) {
    function left_sub_menu($text, $link, $icon, $active)
    {
        return '<li class="nav-item">
                            <a href="' . $link . '" class="nav-link ' . $active . '">
                                <i class="fa ' . $icon . '"></i>
                                <p>' . $text . '</p>
                            </a>
                        </li>';
    }
}

if (!function_exists('storeAsMake')) {
    function storeAsMake($path)
    {
        return 'local/storage/app/public/' . $path;
    }
}

if (!function_exists('left_menu')) {
    function left_menu($text, $text2, $link, $icon, $classSmall, $active)
    {
        return '<li class="nav-item">
                    <a href="' . $link . '" class="nav-link ' . $active . '">
                        <i class="' . $icon . '"></i>
                        <p>
                            ' . $text . '
                            <span class="right badge badge-' . $classSmall . '">' . $text2 . '</span>
                        </p>
                    </a>
                </li>';
    }
}
if (!function_exists('inputSelect2')) {
    function inputSelect2($text, $name, $id, $class, $classTop, $null, $option)

    {
        return '<div class="col-xs-12 col-' . $classTop . '">
                        <div class="form-group">
                            <label>' . $text . '</label>
                            <select name="' . $name . '" id="' . $id . '" class="form-control select2 ' . $class . '" ' . $null . '>
                           ' . $option . '
                            </select>
                        </div>
                    </div>';
    }
}
if (!function_exists('inputCheckbox')) {
    function inputCheckbox($text, $name, $id, $checked, $value)
    {
        return '<div style="margin-left: 30px">

                                        <label class="label-checkbox">' . $text . '

                                            <input type="checkbox" name="' . $name . '" id="' . $id . '" ' . $checked . ' value="' . $value . '">

                                            <span class="checkmark"></span>

                                        </label>

                                    </div>';
    }
}
if (!function_exists('inputSetImage')) {
    function inputSetImage($text, $name, $id, $checked, $value)
    {
        return '<div class="form-group">

                                        <label class="label-checkbox">' . $text . '
'.($text=='' ?'':' <input type="radio" name="' . $name . '" id="' . $id . '" ' . $checked . ' value="' . $value . '">').'
                                           

                                             &nbsp;&nbsp;&nbsp;&nbsp;<a  href="javascript:void;" onclick="del('.$value.')" title="ลบรูปภาพนี้" class="btn btn-flat btn-outline-danger">

                                             <i class="fas fa-trash" aria-hidden="true"></i></a>
'.($text=='' ?'':' <span class="checkmark"></span>').'
                                        </label>

                                    </div>';
    }
}

if (!function_exists('inputText')) {
    function inputText($text, $name, $id, $placeholder, $classTop, $null, $value)
    {
        return '<div class="col-xs-12 col-' . $classTop . '">

                        <div class="form-group">
                            <label>' . $text . '</label>
                        <input type="text" value="' . $value . '" name="' . $name . '" id="' . $id . '" class="form-control" ' . $null . ' placeholder="' . $placeholder . '">
                        </div>
                    </div>';
    }
}
if (!function_exists('inputNumber')) {
    function inputNumber($text, $name, $id, $placeholder, $classTop, $null, $value)
    {
        return '<div class="col-xs-12 col-' . $classTop . '">
                        <div class="form-group">
                            <label>' . $text . '</label>
                        <input type="number" value="' . $value . '" name="' . $name . '" id="' . $id . '" class="form-control" ' . $null . ' placeholder="' . $placeholder . '">
                        </div>
                    </div>';
    }
}

if (!function_exists('inputEmail')) {
    function inputEmail($text, $name, $id, $placeholder, $classTop, $null, $value)
    {
        return '  <div class="col-xs-12 col-' . $classTop . '">

                                    <div class="form-group">

                                        <label>' . $text . '</label>

                                        <div class="input-group">

                                            <div class="input-group-prepend">

                                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>

                                            </div>

                                            <input type="email" ' . $null . ' value="' . $value . '" class="form-control " placeholder="' . $placeholder . '" name="' . $name . '"

                                                   id="' . $id . '">

                                        </div>

                                    </div>

                                </div>';
    }
}

if (!function_exists('inputPassword')) {
    function inputPassword($text, $name, $id, $placeholder, $classTop, $null, $value)
    {
        return '  <div class="col-xs-12 col-' . $classTop . '">

                                    <div class="form-group">

                                        <label>' . $text . '</label>

                                        <div class="input-group">

                                            <div class="input-group-prepend">

                                                <span class="input-group-text"><i class="fas fa-key"></i></span>

                                            </div>

                                            <input type="password" ' . $null . ' value="' . $value . '" class="form-control " placeholder="' . $placeholder . '" name="' . $name . '"

                                                   id="' . $id . '">

                                        </div>

                                    </div>

                                </div>';
    }
}
if (!function_exists('inputTimeRank')) {
    function inputTimeRank($text, $name, $id, $placeholder, $classTop, $null, $value)
    {
        return '  <div class="col-xs-12 col-' . $classTop . '">

                                    <div class="form-group">

                                        <label>' . $text . '</label>

                                        <div class="input-group">

                                            <div class="input-group-prepend">

                                                <span class="input-group-text"><i class="far fa-clock"></i></span>

                                            </div>

                                            <input type="text" ' . $null . ' value="' . $value . '" class="form-control " placeholder="' . $placeholder . '" name="' . $name . '"

                                                   id="' . $id . '">

                                        </div>

                                    </div>

                                </div>';
    }
}
if (!function_exists('inputTextArea')) {
    function inputTextArea($text, $name, $id, $ckeditor, $classTop, $null, $value)
    {
        return '<div class="col-xs-12 col-' . $classTop . '" >
                        <div class="form-group">
                            <label>' . $text . '</label>
                        <textarea  name="' . $name . '" id="' . $id . '" class="form-control ' . $ckeditor . '" ' . $null . '>' . $value . '</textarea>
                        </div>
                    </div>';
    }
}

if (!function_exists('uploadMultipleImage')) {
    function uploadMultipleImage($file, $text, $sizeText, $classDiv, $width, $height)
    {
        $html = ' <div class="col-' . $classDiv . '" style="margin-bottom: 5px">
 <center><div class="form-group">
 <div class="card bg-dark text-white" style="width:' . $width . ' ;height: ' . $height . '!important;">
  <img  src="' . $file . '" id="img-preview2" style="width:' . $width . ' ;height: ' . $height . '!important;" class="">
  <div class="card-img-overlay "><br><br>
    <h4 class="text-center" >' . $sizeText . '</h4>
  </div>
</div>                    
                            </div>
                            <input type="file" accept="image/png, image/jpg, image/gif, image/jpeg" id="fileUpload2"  name="files[]" multiple class="filestyle" data-buttonName="btn-success"

                                   data-icon="false" data-buttonText="' . $text . '" data-input="false"  onchange="readURL2(this)" ></center></div>';
        return $html;
    }
}
if (!function_exists('uploadSingleImage')) {
    function uploadSingleImage($file, $text, $sizeText, $classDiv, $width, $height)
    {
        $html = ' <div class="col-' . $classDiv . '" style="margin-bottom: 5px">
 <center><div class="form-group">
 <div class="card bg-dark text-white" style="width:' . $width . ' ;height: ' . $height . '!important;">
  <img  src="' . $file . '" id="img-preview" style="width:' . $width . ' ;height: ' . $height . '!important;" class="">
  <div class="card-img-overlay "><br><br>
    <h4 class="text-center" >' . $sizeText . '</h4>
  </div>
</div>                    
</div>
<input type="file" accept="image/png, image/jpg, image/gif, image/jpeg" id="fileUpload"  name="fileToUpload" class="filestyle btn btn-primary" data-buttonName="btn-success"
 data-icon="false" data-buttonText="' . $text . '" data-input="false"  onchange="readURL(this)" ></center></div>';

        return $html;
    }
}

if (!function_exists('insertSingleImage')) {
    function insertSingleImage($name, $path)
    {
        $fileName = "fileName" . rand() . time() . '.' . $name->getClientOriginalExtension();
        $name->storeAs('' . $path . '', $fileName);
        return $fileName;
//        ->with('success','You have successfully upload image.');
    }
}
if (!function_exists('insertMultipleImage')) {
    function insertMultipleImage($request, $path, $name)
    {
        $images = [];
        $fileName = $request->file('' . $name . '');
        foreach ($fileName as $file) {
//            $name = rand() . time() . $file->getClientOriginalName();
            $name = rand() . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('' . $path . '', $name);
            $images[] = $name;
        }
        return $images;
//        ->with('success','You have successfully upload image.');
    }
}

if (!function_exists('alertSuccess')) {
    function alertSuccess($title, $message, $link)
    {
        echo '<script>
        alertify.alert(\'' . $title . '\', \'' . $message . '\', function(){ alertify.success(\'Ok\');window.location="' . $link . '" });
    </script>';
    }
}
if (!function_exists('messageError')) {
    function messageError($message)
    {
        echo '<script>
          alertify.error(\'' . $message . '\');
    </script>';
    }
}
if (!function_exists('messageSuccess')) {
    function messageSuccess($message)
    {
        echo '<script>
          alertify.success(\'' . $message . '\');
    </script>';
    }
}
if (!function_exists('alertConfirm')) {
    function alertConfirm($message, $function)
    {
        echo '<script>
         alertify.confirm("' . $message . '",
  function(){
             ' . $function . '
    alertify.success(\'success\');
  },
  function(){
    alertify.error(\'error\');
  });
    </script>';
    }
}
if (!function_exists('buttonManageData')) {
    function buttonManageData($id, $view, $edit, $delete, $route)
    {

        $html = '<center>';
        if ($view === true) {
            $html .= '
             <a title="View" href="javascript:void;" onclick="viewShow(' . $id . ')" class="btn btn-icon btn-primary btn-outline"><i class="icon wb-eye" aria-hidden="true"></i></a>';
        }
        if ($edit === true) {
            $html .= '
            <a title="Edit"  href="' . url('' . $route . '/' . $id . '/edit') . '" class="btn btn-icon btn-success btn-outline"><i class="icon wb-pencil" aria-hidden="true"></i></a>
            ';
        }
        if ($delete === true) {
            $html .= ' 
            <a title="Delete" href="javascript:void;" onclick="deleteData(' . $id . ')" class="btn btn-icon btn-danger btn-outline"><i class="icon wb-trash" aria-hidden="true"></i></a>
           ';
        }
        $html .= '</center>';
        return $html;
    }
}

if (!function_exists('buttonReport')) {
    function buttonReport($url, $report,$id)
    {

        $html = '<center>';
        
        if ($report === true) {
            $html .= ' <a title="showPDF" href="'.$url.'/'.$id.'"  class="btn btn-flat btn-outline-success"><i class="fas fa-print"></i></a>';
        }
       
        $html .= '</center>';
        return $html;
    }
}
if (!function_exists('ModalShow')) {
    function ModalShow($id,$head,$content,$Text = 0,$select = 0,$area= 0)
    {
        if($Text > 0){
            $contents =  '     <div class="form-group">
                                    <select class="form-control" name="gender" id="gender">
                                        <option value="" disabled selected>Choose Gender</option>
                                        <option value="1">Male</option>
                                        <option value="0">Female</option>
                                    </select>
                                    <div class="dropDownSelect2"></div>
                                </div>';
        }
        if($select > 0){
            $contents =  '     <div class="form-group">
                                    <select class="form-control" name="gender" id="gender">
                                        <option value="" disabled selected>Choose Gender</option>
                                        <option value="1">Male</option>
                                        <option value="0">Female</option>
                                    </select>
                                    <div class="dropDownSelect2"></div>
                                </div>';
        }

        $div = '<div class="modal" id="'.$id.'" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">'.$head.'</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      '.$contents.$content.'
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>';
    }
}


//frontEnd
if (!function_exists('salePercen')) {
    function salePercen($priceAgent, $sale)
    {
       $total = round(($sale * 100) /$priceAgent);
       return $total;
    }
}


/**
* Validate Thai national ID
* @param string $nationalId
* @link https://th.wikipedia.org/wiki/เลขประจำตัวประชาชนไทย
* @return bool
*/
if (!function_exists('salePercen')) {
    function isValidNationalId(string $nationalId)
{
  if (strlen($nationalId) === 13) {
    $digits = str_split($nationalId);
    $lastDigit = array_pop($digits);
    $sum = array_sum(array_map(function($d, $k) {
      return ($k+2) * $d;
    }, array_reverse($digits), array_keys($digits)));
    return $lastDigit === strval((11 - $sum % 11) % 10);
  }
  return false;
}
}
