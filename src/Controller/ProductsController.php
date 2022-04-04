<?php
namespace App\Controller;

use App\Controller\AppController;
use Automattic\WooCommerce\Client;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 *
 * @method \App\Model\Entity\Product[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $products = $this->paginate($this->Products);

        $this->set(compact('products'));
    }

    /**
     * View method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => [],
        ]);

        $this->set('product', $product);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $product = $this->Products->newEntity();
        if ($this->request->is('post')) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $this->set(compact('product'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $this->set(compact('product'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Products->get($id);
        if ($this->Products->delete($product)) {
            $this->Flash->success(__('El producto fue eliminado.'));
        } else {
            $this->Flash->error(__('No pudo ser elimando. Vuelva intentar por favor.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Function to get all products from API Woocommerce.
     *
     * @return \Cake\Http\Response|null Redirects
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function getAllProducts()
    {
        $url = 'https://wp-challenge.ecomexperts.com/';
        $consumerKey = 'ck_6af9f99c9b577623f83ec48477c96df2c3d19a28';
        $consumerSecret = 'cs_04bdf34c565ab88b8a3f6eda89eb842ddebc9960';

        $woocommerce = new Client(
            $url,
            $consumerKey,
            $consumerSecret,
            [
                'version' => 'wc/v2',
            ]
        );

        // Endpoints method.
        $results = $woocommerce->get('products');

        foreach ($results as $key => $result) {

            $productFound = $this->Products->getProductSaved($result->id);

            if(empty($productFound)){
                $product = $this->Products->newEntity();
                $product->productId = $result->id;
                $product->sku = $result->sku;
                $product->title = $result->name;
                $product->description = $result->description;
                $product->inventory_quantity = $result->stock_quantity;
                $product->price = $result->price;
                $product->status = $result->status;

                if(!$this->Products->save($product)){
                    return $this->Flash->error(__('Se produjo un error al un producto.'));
                }
            }
        }

        $this->Flash->success(__('Lista de productos cargada con exito.'));

        return $this->redirect($this->referer());
    }

    /**
     *  Function to save a file .csv on server and download by browser a file.csv copy.
     * @return \Cake\Http\Response|null Redirects
     */
    public function export()
    {
        $stamp = time();
        $allProducts = $this->Products->getAllProductsSaved();

        $data = [];
        $data[0] = [ 'sku', 'Nombre del producto', 'Descripción', 'Cantidad', 'Precio', 'status' ];
        if(!empty($allProducts)){
            foreach ($allProducts as $product) {
                $data[] = [
                    $product->sku,
                    $product->title,
                    $product->description,
                    $product->inventory_quantity,
                    $product->price,
                    $product->status,
                ];
            }

            $csvFolderPath = WWW_ROOT.'products'.DS.'csv'.DS;

            if(!is_dir($csvFolderPath)){
              $csvFolderPath = new Folder($csvFolderPath, true, 0775);
              $csvFolderPath = $csvFolderPath->path;
            }

            $fileName = $csvFolderPath.'export_'.$stamp.'.csv';
            $fp = fopen( $fileName, 'w');

            foreach ($data as $fields) {
                fputcsv($fp, $fields);
            }

            fclose($fp);
        }else{
            $this->Flash->error(__('No se hay datos para procesar un archivo CSV.'));
        }

        return $this->redirect(['action' => 'exportView']);
	}

    /**
     * Function to render a view to exports files.
     * @return \Cake\Http\Response|null Redirects
     */
    public function exportView(){

        $dir = new Folder('webroot/products/csv');
        $files = $dir->find('.*\.csv');
        $this->set(compact('files'));
    }

    /**
     * Function to delete a file csv from server.
     * @return \Cake\Http\Response|null Redirects
     */
    public function deleteCsvFile( $cvsFileId = null ){

        $dir = new Folder('webroot/products/csv');
        $files = $dir->find('.*\.csv');

        foreach ($files as $key => $file) {
            debug( $file );
            if($file == $cvsFileId){
                $file = new File($dir->pwd() . DS . $file);
                $file->delete();
                $this->Flash->success(__('Eliminado con exito.'));
                return $this->redirect($this->referer());
            }
        }
        $this->Flash->error(__('Se produjo un error al intentar borrar el archivo.'));
        return $this->redirect($this->referer());
    }

    /**
     * Function to download a file csv.
     * @return \Cake\Http\Response|null Redirects
     */
    public function downloadCsvFile( $file = null )
    {
        $this->autoRender = false;
        $ruta = 'webroot/products/csv/'.$file;
        $this->response->file(
            $ruta,
            ['download' => true, 'name' => $file]
        );
        $this->response->download($file);

        return $this->response;
    }
}
