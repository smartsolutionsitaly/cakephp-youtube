<?php
namespace SmartSolutionsItaly\CakePHP\YouTube\Test\TestCase\Shell;

use SmartSolutionsItaly\CakePHP\YouTube\Shell\YouTubeShell;
use Cake\TestSuite\ConsoleIntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * SmartSolutionsItaly\CakePHP\Shell\YouTubeShell Test Case
 */
class YouTubeShellTest extends TestCase
{
    use ConsoleIntegrationTestTrait;
    /**
     * ConsoleIo mock
     *
     * @var \Cake\Console\ConsoleIo|\PHPUnit_Framework_MockObject_MockObject
     */
    public $io;

    /**
     * Test subject
     *
     * @var YouTubeShell
     */
    public $YouTube;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->io = $this->getMockBuilder('Cake\Console\ConsoleIo')->getMock();
        $this->YouTube = new YouTubeShell($this->io);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->YouTube);

        parent::tearDown();
    }

    /**
     * Test id method
     *
     * @return void
     */
    public function testId()
    {
        $this->YouTube->initialize();
        $id = $this->YouTube->id('nike');
        $this->assertNotEmpty($id);
        $this->assertEquals('UCUFgkRb0ZHc4Rpq15VRCICA', $id);
    }

    /**
     * Test getOptionParser method
     *
     * @return void
     */
    public function testGetOptionParser()
    {
        $this->assertNotNull($this->YouTube->getOptionParser());
    }
}
