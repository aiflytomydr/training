<?php

class CategoriesController extends AppController
{

    /**
     * uses
     * 
     * @var array 
     */
    public $uses = array('Category', 'Transaction', 'Wallet');

    /**
     * create category info 
     * 
     * @return mixed
     */
    public function add()
    {
        $this->__redirectIfEmptyWallet();
        $this->set('title_for_layout', 'Add Category');
        $this->set('listWallet', $this->Wallet->getWalletsOfUser(AuthComponent::user('id')));

        if (!$this->request->is(array('post', 'put'))) {
            return;
        }

        $this->Category->set($this->request->data);
        if ($this->Category->validates()) {

            //process icon upload
            $catIcon = null;
            if (!empty($this->request->data['Category']['icon']['size'])) {
                $catIcon = $this->__processUploadImage(
                        AppConstant::FOLDER_UPL, $this->request->data['Category']['icon']);
            }

            $this->request->data['Category']['icon'] = $catIcon;

            if ($this->Category->createCategory($this->request->data)) {
                $this->Session->setFlash("Add new category complete.");

                return $this->redirect(array(
                            'controller' => 'categories',
                            'action'     => 'listCategories',
                ));
            }
            $this->Session->setFlash("Have error! Please try again.");
        }
    }

    /**
     * show list categories
     */
    public function listCategories()
    {
        $this->__redirectIfEmptyWallet();

        $listCategories = $this->Category->getCategoriesOfWallet(
                AuthComponent::user('current_wallet'));
        $this->set('listCategories', $listCategories);
    }

    /**
     * edit category information by id
     * 
     * @param int $id Category id
     */
    public function edit($id)
    {
        $catObj = $this->Category->findById($id);
        if (empty($catObj)) {
            throw new NotFoundException('Could not find that category.');
        }

        if (!empty($catObj['Category']['wallet_id']) &&
                $catObj['Category']['wallet_id'] !== AuthComponent::user('current_wallet')) {
            throw new NotFoundException('Access is denied.');
        }

        $this->set('title_for_layout', 'Edit Category');
        $this->set('listWallet', $this->Wallet->getWalletsOfUser(AuthComponent::user('id')));

        if (empty($this->request->data)) {
            $this->request->data = $catObj;
        }

        if (!$this->request->is(array('post', 'put'))) {
            return;
        }

        //process icon upload
        $catIcon = $catObj['Category']['icon'];
        if (!empty($this->request->data['Category']['icon']['size'])) {
            $catIcon = $this->__processUploadImage(
                    AppConstant::FOLDER_UPL, $this->request->data['Category']['icon']);
        }
        $this->request->data['Category']['icon'] = $catIcon;

        $this->Category->set($this->request->data);
        if ($this->Category->validates()) {

            $isUpdated = $this->Category->updateById($id, $this->request->data);
            if ($isUpdated) {
                $this->Session->setFlash("Update Category information complete.");
                return $this->redirect(array(
                            'controller' => 'categories',
                            'action'     => 'listCategories',
                ));
            }
            $this->Session->setFlash("Have error! Please try again.");
        }
    }

    /**
     * delete category by id
     * 
     * @param int $id Category id
     */
    public function delete($id)
    {
        $this->autoRender = false;

        if (!$this->request->is('post')) {
            throw new BadRequestException('Request not found.');
        }

        $catObj = $this->Category->findById($id);
        if (empty($catObj)) {
            throw new NotFoundException('Could not find that category.');
        }

        //using transaction for delete data
        $dbSource   = $this->Category->getDataSource();
        $dbSource->begin();
        $flagDelete = true; //flag save status function delete

        if (!$this->Category->deleteById($id)) {
            $flagDelete = false;
        }
        if (!$this->Transaction->deleteTransactionsOfCategory($id)) {
            $flagDelete = false;
        }

        if (!$flagDelete) {
            $dbSource->rollback();
            $this->Session->setFlash("Have error! Please try again.");
            return;
        }
        
        $dbSource->commit();
        return $this->redirect(array(
                    'controller' => 'categories',
                    'action'     => 'listCategories',
        ));
    }

    /**
     * process image file upload
     * 
     * @param type $rootFolder Folder contain file images
     * @param type $fileObj File image upload
     * @return string
     */
    private function __processUploadImage($rootFolder, $fileObj)
    {
        $target_dir  = WWW_ROOT . $rootFolder;
        $target_file = $target_dir . basename($fileObj["name"]);

        if (!move_uploaded_file($fileObj['tmp_name'], $target_file)) {
            return false;
        }
        return '/' . $rootFolder . $fileObj['name'];
    }

    /**
     * Check current wallet exists or not
     * 
     * If not exists -> not add & show list category
     */
    private function __redirectIfEmptyWallet()
    {
        if (empty($this->Wallet->countUserWallets(AuthComponent::user('id')))) {
            return $this->redirect(array(
                        'controller' => 'wallets',
                        'action'     => 'listWallet',
            ));
        }
    }

}
