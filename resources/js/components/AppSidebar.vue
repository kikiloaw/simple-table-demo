<script setup lang="ts">
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { dashboard } from '@/routes';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import {
    BookOpen,
    Database,
    FileText,
    Folder,
    FolderTree,
    LayoutGrid,
    Palette,
    Server,
    Table,
    Zap,
} from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';

const mainNavItems: NavItem[] = [
    {
        title: 'Basic Usage',
        href: '/docs/simple-table/basic',
        icon: Table,
    },
    {
        title: 'Fixed Columns',
        href: '/docs/simple-table/fixed-columns',
        icon: LayoutGrid, 
    },
    {
        title: 'Custom Slots',
        href: '/docs/simple-table/custom-slots',
        icon: FileText,
    },
    {
        title: 'Server-Side Data',
        href: '/docs/simple-table/server-side',
        icon: Database,
    },
    {
        title: 'Theming',
        href: '/docs/simple-table/theming',
        icon: Palette,
    },
    {
        title: 'Caching',
        href: '/docs/simple-table/server-side-caching',
        icon: Zap,
    },
    {
        title: 'Server Headers',
        href: '/docs/simple-table/group-headers-server',
        icon: Server,
    },
    {
        title: 'Client Sort/Group',
        href: '/docs/simple-table/group-headers-client-transform',
        icon: FolderTree,
    },
    {
        title: 'Dynamic Columns',
        href: '/docs/simple-table/dynamic',
        icon: LayoutGrid, // Reusing LayoutGrid or finding another like 'Columns' if available, but LayoutGrid is fine
    },
    {
        title: 'Fahad Select',
        href: '/docs/fahad-select',
        icon: Database,
    },
];

const footerNavItems: NavItem[] = [
    {
        title: 'Github Repo',
        href: 'https://github.com/laravel/vue-starter-kit',
        icon: Folder,
    },
    {
        title: 'Documentation',
        href: 'https://laravel.com/docs/starter-kits#vue',
        icon: BookOpen,
    },
];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="dashboard()">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <NavFooter :items="footerNavItems" />
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
