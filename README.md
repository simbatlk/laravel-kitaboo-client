[![Build Status](https://travis-ci.org/simbatlk/laravel-kitaboo-client.svg?branch=master)](https://travis-ci.org/simbatlk/laravel-kitaboo-client.svg?branch=master) [![PhpStAn](https://img.shields.io/badge/PHPStan-enabled-brightgreen.svg?style=flat)](https://github.com/phpstan/phpstan)

**Installation**

composer require thunderlane/laravel-kitaboo-client

**Setup**

Add the following lines to your .env file:

	KITABOO_CONTEXT_URL=https://kitaboo.endpoint
	KITABOO_CLIENT_ID=<CLIENT ID>
	KITABOO_CONSUMER_KEY=<CONSUMER KEY>
	KITABOO_CONSUMER_SECRET=<CONSUMER SECRET>
	
Run

	php artisan vendor:publish

**Example usage**

	use Thunderlane\Kitaboo\KitabooInterface;
	
	class YourController
	{
		/**
		* @var Thunderlane\Kitaboo\KitabooInterface
		*/
		private $kitaboo;
	
		public function __construct(KitabooInterface $kitaboo)
		{
			$this->kitaboo = $kitaboo;
		}	
	
		/**
		 * @throws \Thunderlane\Kitaboo\Exceptions\UnknownEntityException
		 */
		public function yourAction()
		{
			$userService = $this->kitaboo->getReaderServices()->getUserService();
			$userService->authenticateUser('USERNAME', 'PASSWORD');
	
			$token = $userService->getCurrentUserToken();
			$userService->setCurrentUserToken($token);
	
			$user = $userService->getCurrentUser();
			$userService->setCurrentUser($user);
	
			$collectionService = $this->kitaboo->getExternalServices()->getCollectionService();
			$collectionService->listCollection();
		}
	}