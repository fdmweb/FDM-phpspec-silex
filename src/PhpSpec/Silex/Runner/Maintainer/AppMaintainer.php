<?php
namespace PhpSpec\Silex\Runner\Maintainer;

use PhpSpec\Loader\Node\ExampleNode;
use PhpSpec\Runner\CollaboratorManager;
use PhpSpec\Runner\Maintainer\Maintainer;
use PhpSpec\Runner\Maintainer\MaintainerInterface;
use PhpSpec\Runner\MatcherManager;
use PhpSpec\Specification;
use PhpSpec\SpecificationInterface;
use Silex\Application;

/**
 * @author Artur Lasota <lasota.artur@gmail.com>
 * @author Andrew Plank <apl@fdm.dk>
 */
class AppMaintainer implements Maintainer
{
    /**
     * @var Application
     */
    private $app;

    /**
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * @param ExampleNode $example
     * @return bool
     */
    public function supports(ExampleNode $example) : bool
    {

        $specClassName = $example->getSpecification()->getClassReflection()->getName();
        return in_array('PhpSpec\\Silex\\SilexObjectBehavior', class_parents($specClassName));
    }

    /**
     * {@inheritdoc}
     */
    public function prepare(ExampleNode $example, Specification $context,
                            MatcherManager $matchers, CollaboratorManager $collaborators)
    {
        $reflection =
            $example
                ->getSpecification()
                ->getClassReflection()
                ->getMethod('setApp');

        $reflection->invokeArgs($context, array($this->app));
    }

    /**
     * {@inheritdoc}
     */
    public function teardown(ExampleNode $example, Specification $context,
                             MatcherManager $matchers, CollaboratorManager $collaborators)
    {
    }

    /**
     * @return int
     */
    public function getPriority()
    {
        return 1000;
    }
}
