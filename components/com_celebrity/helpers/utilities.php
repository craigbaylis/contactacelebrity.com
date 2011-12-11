<?php 
class CelebrityUtilitiesHelper
{
    function getAliasName($name)
    {
        $name = JFilterOutput::stringURLSafe($name);
        if(trim(str_replace('-','',$name)) == '') {
            $datenow    = &JFactory::getDate();
            $name         = $datenow->toFormat("%Y-%m-%d-%H-%M-%S");
        }
        return $name;
    }
    
    function createFolder($folder)
    {
        $paramsC = JComponentHelper::getParams('com_phocagallery');
        $folder_permissions = $paramsC->get( 'folder_permissions', 0755 );
    
        $folder = JPATH_ROOT . DS . 'images' . DS . 'phocagallery' . DS . $folder;    
        if (strlen($folder) > 0) {                
            if (!JFolder::exists($folder) && !JFile::exists($folder)) {
            
                // Because of problems on some servers:
                // It is temporary solution
                switch((int)$folder_permissions) {
                    case 777:
                        @JFolder::create($folder, 0777 );
                    break;
                    case 705:
                        @JFolder::create($folder, 0705 );
                    break;
                    case 666:
                        @JFolder::create($folder, 0666 );
                    break;
                    case 644:
                        @JFolder::create($folder, 0644 );
                    break;                
                    case 755:
                    default:
                        @JFolder::create($folder, 0755 );
                    break;
                }
                //@JFolder::create($folder, $folder_permissions );
                if (isset($folder)) {
                    @JFile::write($folder.DS."index.html", "<html>\n<body bgcolor=\"#FFFFFF\">\n</body>\n</html>");
                }
                // folder was not created
                if (!JFolder::exists($folder)) {
                    $errorMsg = "CreatingFolder";
                    return false;
                }
            } else {
                $errorMsg = "FolderExists";
                return false;
            }
        } else {
            $errorMsg = "FolderNameEmpty";
            return false;
        }
        return true;
    }    
}
?>