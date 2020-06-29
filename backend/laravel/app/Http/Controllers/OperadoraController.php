<?php

namespace App\Http\Controllers;

use App\Operadora;
use Illuminate\Http\Request;
use Validator;
use Swagger\Annotations as SWG;

class OperadoraController extends Controller
{

    /**
     * @SWG\Get(path="/operadoras", tags={"operadoras"}, summary="Lista todas as operadoras cadastradas",
     *     produces={"application/json"},
     * @SWG\Parameter(
     *     name="operadoras",
     *     description="Retorna todas as operadoras",
     *     in="query",
     *     required=false,
     *     type="string"),
     * @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/operadora")
     *         ),
     *     ),
     *     @SWG\Response(
     *         response="400",
     *         description="Invalid tag value",
     *     )
     *)
     */
    public function index()
    {
        $operadoras = Operadora::whereNotNull('id')->take(10)->get();

        $operadoras->transform(function(Operadora $operadoras){
            return [
                'id' => $operadoras->id,
                'nome' => $operadoras->nome,
                'codigo' => $operadoras->codigo
            ];
        })->values();

        return response()->json([$operadoras]);
    }

    /**
     * @SWG\Get(
     *     path="/operadoras/{id}",
     *     summary="retorna uma operadora por id",
     *     description="Retorna uma operadora especifico",
     *     operationId="find",
     *     tags={"operadoras"},
     *     consumes={
     *         "application/xml",
     *         "application/json",
     *         "application/x-www-form-urlencoded"
     *     },
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         description="id da operadora para retorno",
     *         in="path",
     *         name="id",
     *         required=true,
     *         type="integer",
     *         format="int64"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(ref="#/definitions/operadora")
     *     ),
     *     @SWG\Response(
     *         response="400",
     *         description="Id inválido"
     *     ),
     *     @SWG\Response(
     *         response="404",
     *         description="operadora não encontrado"
     *     )
     * )
     */
    public function find($id)
    {
        $operadoras = Operadora::where('id', $id)->get();

        return $operadoras->transform(function(Operadora $operadoras){
            return [
                'id' => $operadoras->id,
                'nome' => $operadoras->nome,
                'codigo' => $operadoras->codigo
            ];
        });
    }

    /**
     * @SWG\Post(
     * 		path="/operadoras",
     * 		tags={"operadoras"},
     * 		operationId="createOperadoras",
     * 		summary="Criar uma nova Operadora",
     * 		@SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(
     *              required={"nome", "codigo"},
     *              @SWG\Property(property="nome",  type="string",  ),
     *              @SWG\Property(property="codigo", type="integer", ),
     *
     *		    ),
     *      ),
     * 		@SWG\Response(
     * 			status=200,
     * 			description="success",
     * 		),
     * 		@SWG\Response(
     * 			status="default",
     * 			description="error",
     * 		),
     * 	)
     *
     */
    public function store(Request $request)
    {

        $criaOperadora = Operadora::create([
            'nome'      => $request->nome,
            'codigo'    => $request->codigo
        ]);

        return response('Cadastrado com sucesso');
    }

    /**
     * @SWG\Put(
     *     path="/operadoras/{id}",
     *     tags={"operadoras"},
     *     operationId="edit",
     *     summary="Editar operadora",
     *     description="Editar uma operadora",
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *          name="id",
     *          in="path",
     *          description="informe o id",
     *          required=true,
     *          type="integer"
     *     ),
     *     @SWG\Parameter(
     *         name="body",
     *         in="body",
     *         required=true,
     *          @SWG\Schema(
     *              required={"nome", "codigo"},
     *              @SWG\Property(property="nome",  type="string",  ),
     *              @SWG\Property(property="codigo", type="integer", ),     *
     *		    ),
     *     ),
     *     @SWG\Response(
     *         response=400,
     *         description="Invalid ID supplied",
     *     ),
     *     @SWG\Response(
     *         response=404,
     *         description="Operadora não encontrada",
     *     )
     * )
     */
    public function update($id, Request $request)
    {
        $task = Operadora::findOrFail($id);
        $data = $request->all();
        $validator = Validator::make($data, [
            'nome'   => 'required',
            'codigo' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message'   => 'Invalid credentials',
                'errors'        => $validator->errors()->all()
            ], 422);
        }else{


            $task->fill($data)->save();

            return response('editado com sucesso');
            //return redirect()->back();
        }


    }

    /**
     * @SWG\Delete(
     *     path="/operadoras/{id}",
     *     summary="Excluir uma operadora",
     *     description="",
     *     operationId="delete",
     *     consumes={"application/xml", "application/json", "multipart/form-data", "application/x-www-form-urlencoded"},
     *     produces={"application/xml", "application/json"},
     *     tags={"operadoras"},
     *     @SWG\Parameter(
     *         description="Deleta uma operadora por id informado",
     *         in="path",
     *         name="id",
     *         required=true,
     *         type="integer",
     *         format="int64"
     *     ),
     *     @SWG\Response(
     *         response=400,
     *         description="Invalid pet value"
     *     )
     * )
     */
    public function delete($id)
    {
        $operadoras = Operadora::findOrFail($id);
        $operadoras->delete();

        return 'Operadora Excluída com Sucesso';
    }
}
