<?php

namespace App\Http\Responsable\productos;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use GuzzleHttp\Client;

class ProductoUpdate implements Responsable
{
    public function toResponse($request)
    {
        $formEditarPreciosEntradas = request('form_editar_precios_entradas', null); // Identifico el formualrio origen

        $idProducto = request('idProductoEdit', null);
        $nombreProductoEdit = request('nombreProductoEdit', null);
        $categoriaEdit = request('categoriaEdit', null);
        $descripcionEdit = request('descripcionEdit', null);
        $precioUnitarioEdit = request('precioUnitarioEdit', null);
        $precioPorMayorEdit = request('precioPorMayorEdit', null);
        $precioDetalEdit = request('precioDetalEdit', null);
        $stockMinimoEdit = request('stockMinimoEdit', null);
        $referencia = request('referenciaEdit', null);
        $fechaVencimiento = request('fechaVencimientoEdit', null);

        // ===================================================================

        $imagenProductoBase64Edit = null;

        if ($request->hasFile('imagenProductoEdit')) {
            $imagenProducto = $request->file('imagenProductoEdit');

            if ($imagenProducto->isValid()) {
                // Validación de tipo MIME
                $tiposPermitidos = ['image/jpg', 'image/jpeg', 'image/png', 'image/webp'];
                $tipoMime = $imagenProducto->getMimeType();

                if (!in_array($tipoMime, $tiposPermitidos)) {
                    alert()->error('Error', 'El tipo de imagen no es válido. Solo se permiten JPG, JPEG, PNG o WEBP.');
                    return back();
                }

                // Validación de tamaño (2 MB = 2048 KB)
                $tamanioMaximoKB = 2048;
                $tamanioArchivoKB = $imagenProducto->getSize() / 1024;

                if ($tamanioArchivoKB > $tamanioMaximoKB) {
                    alert()->error('Error', 'La imagen excede el tamaño máximo permitido de 2 MB.');
                    return back();
                }

                // Codificación base64
                $contenido = file_get_contents($imagenProducto);
                $imagenProductoBase64Edit = 'data:' . $imagenProducto->getMimeType() . ';base64,' . base64_encode($contenido);
            }
        }

        // ===================================================================

        $baseUri = env('BASE_URI');
        $clientApi = new Client(['base_uri' => $baseUri]);

        try {
            // Obtener los datos actuales del producto antes de actualizar
            $peticionProducto = $clientApi->post($baseUri.'query_producto/'.$idProducto, [
                'query' => [
                    'empresa_actual' => session('empresa_actual')
                ]
            ]);
            $productoActual = json_decode($peticionProducto->getBody()->getContents());

            // Enviar la actualización solo con los datos necesarios
            $peticionProductoUpdate = $clientApi->put($baseUri.'producto_update/'.$idProducto, [
                'json' => [
                    'imagen_producto' => $imagenProductoBase64Edit ?? $productoActual->imagen_producto,
                    'nombre_producto' => $nombreProductoEdit ?? $productoActual->nombre_producto,
                    'id_categoria' => $categoriaEdit ?? $productoActual->id_categoria,
                    'descripcion' => $descripcionEdit ?? $productoActual->descripcion,
                    'precio_unitario' => $precioUnitarioEdit ?? $productoActual->precio_unitario,
                    'precio_detal' => $precioDetalEdit ?? $productoActual->precio_detal,
                    'precio_por_mayor' => $precioPorMayorEdit ?? $productoActual->precio_por_mayor,
                    'stock_minimo' => $stockMinimoEdit ?? $productoActual->stock_minimo,
                    'referencia' => $referencia,
                    'fecha_vencimiento' => $fechaVencimiento,
                    'id_audit' => session('id_usuario'),
                    'empresa_actual' => session('empresa_actual')
                ]
            ]);
            $respuestaProductoUpdate = json_decode($peticionProductoUpdate->getBody()->getContents());

            // ===================================================================

            if(isset($respuestaProductoUpdate) && !empty($respuestaProductoUpdate)) {

                if ($formEditarPreciosEntradas == 'formEditarPreciosEntradas') {
                    alert()->success('Proceso Exitoso', 'Producto creado satisfactoriamente');
                    return redirect()->to(route('entradas.create'));
                } else {
                    alert()->success('Proceso Exitoso', 'Producto editado satisfactoriamente');
                    return redirect()->to(route('productos.index'));
                }
            }
        } catch (Exception $e) {
            alert()->error('Error', 'Excepción, intente de nuevo, si el problema persiste, contacte a Soporte.');
            return back();
        }
    }
}
