<?php
namespace F3\Changelog\Git;

use F3\Changelog\RemoteFactory;
use PHPUnit\Framework\TestCase;

class RepositoryFactoryTest extends TestCase
{
    public function urlDataProvider(): array
    {
        return [
            [
                'https://github.com/foo/bar/compare/a...b',
                'https://github.com/foo/bar.git',
            ],
            [
                'https://github.com/foo/bar/compare/a...b',
                'https://github.com/foo/bar',
            ],
            [
                'https://github.com/f3ath/git-changelog/compare/a...b',
                'git@github.com:f3ath/git-changelog.git',
            ],
        ];
    }

    /**
     * @param string $expected
     * @param string $url

     * @dataProvider urlDataProvider
     */
    public function testValidUrl(string $expected, string $url)
    {
        $factory = new RemoteFactory();
        $this->assertEquals($expected, $factory->createByUrl($url)->getDiffUrl('a', 'b'));
    }

    /**
     * @expectedException \UnexpectedValueException
     */
    public function testInvalidUrl()
    {
        $factory = new RemoteFactory();
        $factory->createByUrl('https://google.com');
    }
}
