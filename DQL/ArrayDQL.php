<?php

namespace ITDoors\CommonBundle\DQL;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\SqlWalker;
use Doctrine\ORM\Query\Parser;

/**
 * Array DQL function
 *
 * @author Pavel Pecheny <ppecheny@gmail.com>
 *
 */
class ArrayDQL extends FunctionNode
{
    public $select = null;

    /**
     * {@inheritDoc}
     *
     * @param Parser $parser
     */
    public function parse(Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->select = $parser->Subselect();
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }

    /**
     * {@inheritDoc}
     *
     * @param SqlWalker $sqlWalker
     */
    public function getSql(SqlWalker $sqlWalker)
    {
        return sprintf('ARRAY(%s)', $this->select->dispatch($sqlWalker));
    }
}
