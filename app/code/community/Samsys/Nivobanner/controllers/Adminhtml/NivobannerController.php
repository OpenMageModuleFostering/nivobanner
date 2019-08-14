<?php
/**
 * Sam-Sys
 * @category   Samsys
 * @package    Samsys_Nivobanner
 * @copyright  Copyright (c) 2013-2014 sam-sys. (http://www.sam-sys.in)
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */
class Samsys_Nivobanner_Adminhtml_NivobannerController extends Mage_Adminhtml_Controller_Action {

    protected function _initAction() {
        $this->loadLayout()
		/*set menu to active*/
                ->_setActiveMenu('nivobanner/items')
                ->_addBreadcrumb(Mage::helper('adminhtml')->__('Items Manager'), Mage::helper('adminhtml')->__('Item Manager'));

        return $this;
    }

    public function indexAction() {
     $this->_title($this->__('Nivo-Gallery Manager'));
        $this->_initAction();
		
		/*below line can also be used to render the admin layout*/
		// $this->_addContent($this->getLayout()->createBlock('nivobanner/adminhtml_nivobanner'));
        $this->renderLayout();
    }

    public function editAction() {
        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('nivobanner/nivobanner')->load($id);

        if ($model->getId() || $id == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $model->setData($data);
            }

            Mage::register('nivobanner_data', $model);

            $this->loadLayout();
            $this->_setActiveMenu('nivobanner/items');

            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));

            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

            $this->_addContent($this->getLayout()->createBlock('nivobanner/adminhtml_nivobanner_edit'))
                    ->_addLeft($this->getLayout()->createBlock('nivobanner/adminhtml_nivobanner_edit_tabs'));
            $version = substr(Mage::getVersion(), 0, 3);
			
			/*load wysiwyg editor path= model->wysiwyg->config.php*/
            if (in_array($version, array('1.4','1.5','1.6','1.7')) && Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
                $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
            }
            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('nivobanner')->__('Item does not exist'));
            $this->_redirect('*/*/');
        }
    }

    public function newAction() {
        $this->_forward('edit');
    }

    public function saveAction() {
        $imagedata = array();
        if (!empty($_FILES['filename']['name'])) {
            try {
				
                $ext = substr($_FILES['filename']['name'], strrpos($_FILES['filename']['name'], '.') + 1);
                $fname = 'File-' . time() . '.' . $ext;
                $uploader = new Varien_File_Uploader('filename');
                $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png')); // or pdf or anything

                $uploader->setAllowRenameFiles(true);
                $uploader->setFilesDispersion(false);

                $path = Mage::getBaseDir('media').DS.'nivo'.DS.'banner';

                $uploader->save($path, $fname);

                $imagedata['filename'] = 'nivo/banner/'.$fname;
				
				$data = $this->getRequest()->getPost();
				
				 
				 if (isset($data['filename']['delete']) && $data['filename']['delete'] == 1) {
				 
					 $model = Mage::getModel('nivobanner/nivobanner')->load($this->getRequest()->getParam('id'));
					$_helper = Mage::helper('nivobanner');
					$filePath = Mage::getBaseDir('media').DS.$_helper->updateDirSepereator($model->getFilename());
					$this->removeFile($filePath);
					
				 
                }
				
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        if ($data = $this->getRequest()->getPost()) {
            if (!empty($imagedata['filename'])) {
                $data['filename'] = $imagedata['filename'];
            } else {
                if (isset($data['filename']['delete']) && $data['filename']['delete'] == 1) {
                    if ($data['filename']['value'] != '') {
                        $_helper = Mage::helper('nivobanner');
                        $this->removeFile(Mage::getBaseDir('media').DS.$_helper->updateDirSepereator($data['filename']['value']));
                    }
                    $data['filename'] = '';
                } else {
                    unset($data['filename']);
                }
            }
            $model = Mage::getModel('nivobanner/nivobanner');
            $model->setData($data)
                    ->setId($this->getRequest()->getParam('id'));

            try {
                if ($model->getCreatedTime == NULL || $model->getUpdateTime() == NULL) {
                    $model->setCreatedTime(now())
                            ->setUpdateTime(now());
                } else {
                    $model->setUpdateTime(now());
                }

                $model->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('nivobanner')->__('Item was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);

                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));
                    return;
                }
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('nivobanner')->__('Unable to find item to save'));
        $this->_redirect('*/*/');
    }

    public function deleteAction() {
        if ($this->getRequest()->getParam('id') > 0) {
            try {
                $model = Mage::getModel('nivobanner/nivobanner')->load($this->getRequest()->getParam('id'));
                $_helper = Mage::helper('nivobanner');
                $filePath = Mage::getBaseDir('media').DS.$_helper->updateDirSepereator($model->getFilename());
                $model->delete();
                $this->removeFile($filePath);

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }

    public function massDeleteAction() {
        $bannerIds = $this->getRequest()->getParam('banner');
        if (!is_array($bannerIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select item(s)'));
        } else {
            try {
                foreach ($bannerIds as $bannerId) {
                    $model = Mage::getModel('nivobanner/nivobanner')->load($bannerId);
                    $_helper = Mage::helper('nivobanner');
                    $filePath = Mage::getBaseDir('media').DS.$_helper->updateDirSepereator($model->getFilename());
                    $model->delete();
                    $this->removeFile($filePath);
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                        Mage::helper('adminhtml')->__(
                                'Total of %d record(s) were successfully deleted', count($bannerIds)
                        )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

    public function massStatusAction() {
        $bannerIds = $this->getRequest()->getParam('banner');
        if (!is_array($bannerIds)) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Please select item(s)'));
        } else {
            try {
                foreach ($bannerIds as $bannerId) {
                    $banner = Mage::getSingleton('nivobanner/nivobanner')
                                    ->load($bannerId)
                                    ->setStatus($this->getRequest()->getParam('status'))
                                    ->setIsMassupdate(true)
                                    ->save();
                }
                $this->_getSession()->addSuccess(
                        $this->__('Total of %d record(s) were successfully updated', count($bannerIds))
                );
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

   
    protected function _sendUploadResponse($fileName, $content, $contentType='application/octet-stream') {
        $response = $this->getResponse();
        $response->setHeader('HTTP/1.1 200 OK', '');
        $response->setHeader('Pragma', 'public', true);
        $response->setHeader('Cache-Control', 'must-revalidate, post-check=0, pre-check=0', true);
        $response->setHeader('Content-Disposition', 'attachment; filename=' . $fileName);
        $response->setHeader('Last-Modified', date('r'));
        $response->setHeader('Accept-Ranges', 'bytes');
        $response->setHeader('Content-Length', strlen($content));
        $response->setHeader('Content-type', $contentType);
        $response->setBody($content);
        $response->sendResponse();
        die;
    }

    protected function removeFile($file) {
        try {
            $io = new Varien_Io_File();
            if(!is_dir($file) && file_exists($file)){
                $result = $io->rmdir($file, true);
            }
        } catch (Exception $e) {
			Mage::getSingleton('adminhtml/session')->addError($this->__('Cannot Delete File. Please Delete It Manually)'));
        }
    }

}