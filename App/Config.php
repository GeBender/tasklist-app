<?php
/**
 * (c) Tasklist App: The Simple task list.
 *
 * PHP version 5.6
 *
 * @author  Ge Bender <gesianbender@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 * @link    http://tasklist.gebender.com.br
 */
namespace App;

class Config
{

    /**
     * Entrega as configurações da aplicação
     *
     * @return multitype:multitype:string
     */
    public static function load()
    {
        return [
            'title' => 'The Simple Tasklist',
//             'apiAddress' => 'http://tasklist-api.gebender.com.br'
            'apiAddress' => 'http://localhost:9090'
        ];
    }
}
