<?php
/*
 * This file is part of EC-CUBE
 *
 * Copyright(c) 2000-2015 LOCKON CO.,LTD. All Rights Reserved.
 *
 * http://www.lockon.co.jp/
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */


namespace Eccube\Tests\Web\Admin\Product;

use Eccube\Tests\Web\Admin\AbstractAdminWebTestCase;

class ClassNameControllerTest extends AbstractAdminWebTestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testRoutingAdminProductClassName()
    {
        $this->client->request('GET',
            $this->app->url('admin_product_class_name')
        );
        $this->assertTrue($this->client->getResponse()->isSuccessful());
    }

    public function testRoutingAdminProductClassNameEdit()
    {
        // before
        $TestCreator = $this->app['orm.em']
            ->getRepository('\Eccube\Entity\Member')
            ->find(1);
        $TestClassName = $this->newTestClassName($TestCreator);
        $this->app['orm.em']->persist($TestClassName);
        $this->app['orm.em']->flush();
        $test_class_name_id = $this->app['eccube.repository.class_name']
            ->findOneBy(array(
                'name' => $TestClassName->getName()
            ))
            ->getId();

        // main
        $this->client->request('GET',
            $this->app->url('admin_product_class_name_edit', array('id' => $test_class_name_id))
        );
        $this->assertTrue($this->client->getResponse()->isSuccessful());

        // after
        $this->app['orm.em']->remove($TestClassName);
        $this->app['orm.em']->flush();
    }

    public function testRoutingAdminProductClassNameUp()
    {

        self::markTestSkipped();

        // before
        $TestCreator = $this->app['orm.em']
            ->getRepository('\Eccube\Entity\Member')
            ->find(1);
        $TestClassName = $this->newTestClassName($TestCreator);
        $this->app['orm.em']->persist($TestClassName);
        $this->app['orm.em']->flush();
        $test_class_name_id = $this->app['eccube.repository.class_name']
            ->findOneBy(array(
                'name' => $TestClassName->getName()
            ))
            ->getId();

        // main
        $redirectUrl = $this->app->url('admin_product_class_name');
        $this->client->request('POST',
            $this->app->url('admin_product_class_name_up', array('id' => $test_class_name_id))
        );
        $this->assertTrue($this->client->getResponse()->isRedirect($redirectUrl));

        // after
        $this->app['orm.em']->remove($TestClassName);
        $this->app['orm.em']->flush();
    }

    public function testRoutingAdminProductClassNameDown()
    {

        self::markTestSkipped();

        // before
        $TestCreator = $this->app['orm.em']
            ->getRepository('\Eccube\Entity\Member')
            ->find(1);
        $TestClassName = $this->newTestClassName($TestCreator);
        $this->app['orm.em']->persist($TestClassName);
        $this->app['orm.em']->flush();
        $test_class_name_id = $this->app['eccube.repository.class_name']
            ->findOneBy(array(
                'name' => $TestClassName->getName()
            ))
            ->getId();

        // main
        $redirectUrl = $this->app->url('admin_product_class_name');
        $this->client->request('POST',
            $this->app->url('admin_product_class_name_down', array('id' => $test_class_name_id))
        );
        $this->assertTrue($this->client->getResponse()->isRedirect($redirectUrl));

        // after
        $this->app['orm.em']->remove($TestClassName);
        $this->app['orm.em']->flush();
    }

    public function testRoutingAdminProductClassNameDelete()
    {
        // before
        $TestCreator = $this->app['orm.em']
            ->getRepository('\Eccube\Entity\Member')
            ->find(1);
        $TestClassName = $this->newTestClassName($TestCreator);
        $this->app['orm.em']->persist($TestClassName);
        $this->app['orm.em']->flush();
        $test_class_name_id = $this->app['eccube.repository.class_name']
            ->findOneBy(array(
                'name' => $TestClassName->getName()
            ))
            ->getId();

        // main
        $redirectUrl = $this->app->url('admin_product_class_name');
        $this->client->request('DELETE',
            $this->app->url('admin_product_class_name_delete', array('id' => $test_class_name_id))
        );
        $this->assertTrue($this->client->getResponse()->isRedirect($redirectUrl));

        // after
        $this->app['orm.em']->remove($TestClassName);
        $this->app['orm.em']->flush();
    }

    private function newTestClassName($TestCreator)
    {
        $TestClassName = new \Eccube\Entity\ClassName();
        $TestClassName->setName('形状')
            ->setRank(100)
            ->setDelFlg(false)
            ->setCreator($TestCreator);

        return $TestClassName;
    }
}