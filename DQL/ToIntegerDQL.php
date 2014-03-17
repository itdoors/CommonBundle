<?php

namespace ITDoors\CommonBundle\DQL;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\SqlWalker;

/**
 * ToInteger DQL function
 *
 * @author Pavel Pecheny <ppecheny@gmail.com>
 *
 */
class ToIntegerDQL extends FunctionNode
{
    public $value = null;

    /**
     * {@inheritDoc}
     *
     * @param Parser $parser
     */
    public function parse(Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->value = $parser->StringExpression();
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }

    /**
     * {@inheritDoc}
     *
     * @param SqlWalker $sqlWalker
     */
    public function getSql(SqlWalker $sqlWalker)
    {
        return sprintf('to_integer(%s)', $this->value->dispatch($sqlWalker));
    }
}
