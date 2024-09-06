<?php
declare(strict_types=1);

/**
 * Description of UserQueryTest
 */
class UserQueryTest extends PHPUnit\Framework\TestCase {

	public static function test__construct_whenAllQuery_storesAllParameters(): void {
		$query = array('get' => 'a');
		$user_query = new FreshRSS_UserQuery($query, [], []);
		self::assertEquals('all', $user_query->getGetType());
	}

	public static function test__construct_whenFavoriteQuery_storesFavoriteParameters(): void {
		$query = array('get' => 's');
		$user_query = new FreshRSS_UserQuery($query, [], []);
		self::assertEquals('favorite', $user_query->getGetType());
	}

	public function test__construct_whenCategoryQuery_storesCategoryParameters(): void {
		$category_name = 'some category name';
		/** @var FreshRSS_Category&PHPUnit\Framework\MockObject\MockObject */
		$cat = $this->createMock(FreshRSS_Category::class);
		$cat->expects(self::atLeastOnce())
			->method('name')
			->withAnyParameters()
			->willReturn($category_name);
		$query = array('get' => 'c_1');
		$user_query = new FreshRSS_UserQuery($query, [1 => $cat], []);
		self::assertEquals($category_name, $user_query->getGetName());
		self::assertEquals('category', $user_query->getGetType());
	}

	public function test__construct_whenFeedQuery_storesFeedParameters(): void {
		$feed_name = 'some feed name';
		/** @var FreshRSS_Feed&PHPUnit\Framework\MockObject\MockObject */
		$feed = $this->createMock(FreshRSS_Feed::class);
		$feed->expects(self::atLeastOnce())
			->method('id')
			->withAnyParameters()
			->willReturn(1);
		$feed->expects(self::atLeastOnce())
			->method('name')
			->withAnyParameters()
			->willReturn($feed_name);
		/** @var FreshRSS_Category&PHPUnit\Framework\MockObject\MockObject */
		$cat = $this->createMock(FreshRSS_Category::class);
		$cat->expects(self::atLeastOnce())
			->method('feeds')
			->withAnyParameters()
			->willReturn([1 => $feed]);
		$query = array('get' => 'f_1');
		$user_query = new FreshRSS_UserQuery($query, [1 => $cat], []);
		self::assertEquals($feed_name, $user_query->getGetName());
		self::assertEquals('feed', $user_query->getGetType());
	}

	public static function test__construct_whenUnknownQuery_doesStoreParameters(): void {
		$query = array('get' => 'q');
		$user_query = new FreshRSS_UserQuery($query, [], []);
		self::assertEmpty($user_query->getGetName());
		self::assertEmpty($user_query->getGetType());
	}

	public static function test__construct_whenName_storesName(): void {
		$name = 'some name';
		$query = array('name' => $name);
		$user_query = new FreshRSS_UserQuery($query, [], []);
		self::assertEquals($name, $user_query->getName());
	}

	public static function test__construct_whenOrder_storesOrder(): void {
		$order = 'some order';
		$query = array('order' => $order);
		$user_query = new FreshRSS_UserQuery($query, [], []);
		self::assertEquals($order, $user_query->getOrder());
	}

	public static function test__construct_whenState_storesState(): void {
		$state = FreshRSS_Entry::STATE_NOT_READ | FreshRSS_Entry::STATE_FAVORITE;
		$query = array('state' => $state);
		$user_query = new FreshRSS_UserQuery($query, [], []);
		self::assertEquals($state, $user_query->getState());
	}

	public static function test__construct_whenUrl_storesUrl(): void {
		$url = 'some url';
		$query = array('url' => $url);
		$user_query = new FreshRSS_UserQuery($query, [], []);
		self::assertEquals($url, $user_query->getUrl());
	}

	public static function testToArray_whenNoData_returnsEmptyArray(): void {
		$user_query = new FreshRSS_UserQuery([], [], []);
		self::assertCount(0, $user_query->toArray());
	}

	public static function testToArray_whenData_returnsArray(): void {
		$query = array(
			'get' => 's',
			'name' => 'some name',
			'order' => 'some order',
			'search' => 'some search',
			'state' => FreshRSS_Entry::STATE_ALL,
			'url' => 'some url',
		);
		$user_query = new FreshRSS_UserQuery($query, [], []);
		self::assertCount(6, $user_query->toArray());
		self::assertEquals($query, $user_query->toArray());
	}

	public static function testHasSearch_whenSearch_returnsTrue(): void {
		$query = array(
			'search' => 'some search',
		);
		$user_query = new FreshRSS_UserQuery($query, [], []);
		self::assertTrue($user_query->hasSearch());
	}

	public static function testHasSearch_whenNoSearch_returnsFalse(): void {
		$user_query = new FreshRSS_UserQuery([], [], []);
		self::assertFalse($user_query->hasSearch());
	}

	public static function testHasParameters_whenAllQuery_returnsFalse(): void {
		$query = array('get' => 'a');
		$user_query = new FreshRSS_UserQuery($query, [], []);
		self::assertFalse($user_query->hasParameters());
	}

	public static function testHasParameters_whenNoParameter_returnsFalse(): void {
		$query = array();
		$user_query = new FreshRSS_UserQuery($query, [], []);
		self::assertFalse($user_query->hasParameters());
	}

	public static function testHasParameters_whenParameter_returnTrue(): void {
		$query = array('get' => 's');
		$user_query = new FreshRSS_UserQuery($query, [], []);
		self::assertTrue($user_query->hasParameters());
	}

	public function testIsDeprecated_whenCategoryExists_returnFalse(): void {
		/** @var FreshRSS_Category&PHPUnit\Framework\MockObject\MockObject */
		$cat = $this->createMock(FreshRSS_Category::class);
		$cat->expects(self::atLeastOnce())
			->method('name')
			->withAnyParameters()
			->willReturn('cat 1');
		$query = array('get' => 'c_1');
		$user_query = new FreshRSS_UserQuery($query, [1 => $cat], []);
		self::assertFalse($user_query->isDeprecated());
	}

	public static function testIsDeprecated_whenCategoryDoesNotExist_returnTrue(): void {
		$query = array('get' => 'c_1');
		$user_query = new FreshRSS_UserQuery($query, [], []);
		self::assertTrue($user_query->isDeprecated());
	}

	public function testIsDeprecated_whenFeedExists_returnFalse(): void {
		/** @var FreshRSS_Feed&PHPUnit\Framework\MockObject\MockObject */
		$feed = $this->createMock(FreshRSS_Feed::class);
		$feed->expects(self::atLeastOnce())
			->method('id')
			->withAnyParameters()
			->willReturn(1);
		$feed->expects(self::atLeastOnce())
			->method('name')
			->withAnyParameters()
			->willReturn('feed 1');
		/** @var FreshRSS_Category&PHPUnit\Framework\MockObject\MockObject */
		$cat = $this->createMock(FreshRSS_Category::class);
		$cat->expects(self::atLeastOnce())
			->method('feeds')
			->withAnyParameters()
			->willReturn([1 => $feed]);
		$query = array('get' => 'f_1');
		$user_query = new FreshRSS_UserQuery($query, [1 => $cat], []);
		self::assertFalse($user_query->isDeprecated());
	}

	public function testIsDeprecated_whenFeedDoesNotExist_returnTrue(): void {
		/** @var FreshRSS_Category&PHPUnit\Framework\MockObject\MockObject */
		$cat = $this->createMock(FreshRSS_Category::class);
		$cat->expects(self::atLeastOnce())
			->method('feeds')
			->withAnyParameters()
			->willReturn([]);
		$query = array('get' => 'f_1');
		$user_query = new FreshRSS_UserQuery($query, [1 => $cat], []);
		self::assertTrue($user_query->isDeprecated());
	}

	public static function testIsDeprecated_whenAllQuery_returnFalse(): void {
		$query = array('get' => 'a');
		$user_query = new FreshRSS_UserQuery($query, [], []);
		self::assertFalse($user_query->isDeprecated());
	}

	public static function testIsDeprecated_whenFavoriteQuery_returnFalse(): void {
		$query = array('get' => 's');
		$user_query = new FreshRSS_UserQuery($query, [], []);
		self::assertFalse($user_query->isDeprecated());
	}

	public static function testIsDeprecated_whenUnknownQuery_returnFalse(): void {
		$query = array('get' => 'q');
		$user_query = new FreshRSS_UserQuery($query, [], []);
		self::assertFalse($user_query->isDeprecated());
	}

}
