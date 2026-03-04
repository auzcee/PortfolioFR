// lib/presentation/screens/main_scaffold.dart
// ─────────────────────────────────────────────────────────────────────────────
// Root scaffold: hosts the 5-tab BottomNavigationBar and tab bodies.
// Uses IndexedStack so each tab preserves its scroll/state position.
// Navigation state is managed by NavigationProvider (ChangeNotifier).
// ─────────────────────────────────────────────────────────────────────────────

import 'package:flutter/material.dart';
import 'package:provider/provider.dart';

import 'package:portfolioph/presentation/providers/navigation_provider.dart';
import 'package:portfolioph/presentation/screens/dashboard/dashboard_screen.dart';
import 'package:portfolioph/presentation/screens/portfolio/portfolio_screen.dart';
import 'package:portfolioph/presentation/screens/resume/resume_screen.dart';
import 'package:portfolioph/presentation/screens/skills/skills_screen.dart';
import 'package:portfolioph/presentation/screens/profile/profile_screen.dart';

class MainScaffold extends StatelessWidget {
  const MainScaffold({super.key});

  // ── Tab definitions (order must match AppConstants.navIndex* values) ──────────
  static const List<_TabItem> _tabs = [
    _TabItem(
      icon: Icons.dashboard_outlined,
      activeIcon: Icons.dashboard_rounded,
      label: 'Home',
    ),
    _TabItem(
      icon: Icons.folder_open_outlined,
      activeIcon: Icons.folder_rounded,
      label: 'Portfolio',
    ),
    _TabItem(
      icon: Icons.description_outlined,
      activeIcon: Icons.description_rounded,
      label: 'Resume',
    ),
    _TabItem(
      icon: Icons.bar_chart_outlined,
      activeIcon: Icons.bar_chart_rounded,
      label: 'Skills',
    ),
    _TabItem(
      icon: Icons.person_outline_rounded,
      activeIcon: Icons.person_rounded,
      label: 'Profile',
    ),
  ];

  static const List<Widget> _bodies = [
    DashboardScreen(),
    PortfolioScreen(),
    ResumeScreen(),
    SkillsScreen(),
    ProfileScreen(),
  ];

  @override
  Widget build(BuildContext context) {
    return Consumer<NavigationProvider>(
      builder: (context, nav, _) {
        return Scaffold(
          // IndexedStack keeps all tab states alive simultaneously.
          body: IndexedStack(index: nav.currentIndex, children: _bodies),
          bottomNavigationBar: BottomNavigationBar(
            currentIndex: nav.currentIndex,
            onTap: nav.goTo,
            items: _tabs
                .map(
                  (t) => BottomNavigationBarItem(
                    icon: Icon(t.icon),
                    activeIcon: Icon(t.activeIcon),
                    label: t.label,
                  ),
                )
                .toList(),
          ),
        );
      },
    );
  }
}

/// Lightweight data class for tab metadata.
class _TabItem {
  final IconData icon;
  final IconData activeIcon;
  final String label;

  const _TabItem({
    required this.icon,
    required this.activeIcon,
    required this.label,
  });
}
