## Git Branching Strategy

The main branches
* master
* trunk

We consider `origin/master` to be the main branch where the source code of `HEAD` always reflects a production-ready state.

We consider `origin/trunk` to be the main branch where the source code of `HEAD` always reflects the latest stable release.

When the source code in the trunk branch reaches a stable point and is ready to be released, all of the changes are merged back into master using a release workflow.

Therefore, each time when changes are merged back into `origin/master`, this is *a new production release by definition*.

## Supporting branches

Our development model uses a variety of supporting branches to aid parallel development of work between team members, prepare for production releases and to assist in quickly fixing live production problems.

Unlike the main branches, these branches always have a limited life time, since they will be removed eventually.

The supporting branches we may use are:

* Sprint branches
* Feature branches
* Release branches
* Hotfix branches

### Sprint branches

May branch off from:
  *trunk*
Must merge back into:
  *trunk*
Branch naming convention:
  anything except master, trunk, release-*, or hotfix-*

### Feature branches

May branch off from:
  *trunk*
Must merge back into:
  *trunk*
Branch naming convention:
  anything except master, trunk, release-*, or hotfix-*

### Release branches

May branch off from:
  *trunk*
Must merge back into:
  *trunk* and *master*
Branch naming convention:
  release-*

Release branches support preparation of a new production release. They allow for last-minute dotting of i’s and crossing t’s. Furthermore, they allow for minor bug fixes and preparing meta-data for a release (version number, build dates, etc.). By doing all of this work on a release branch, the develop branch is cleared to receive features for the next big release.

#### Creating a release branch
```
$ git checkout -b release-1.2 trunk
Switched to a new branch "release-1.2"
$ ./bump-version.sh 1.2
Files modified successfully, version bumped to 1.2.
$ git commit -a -m "Bumped version number to 1.2"
[release-1.2 74d9424] Bumped version number to 1.2
1 files changed, 1 insertions(+), 1 deletions(-)
```

#### Finishing a release branch
When the state of the release branch is ready to become a real release, some actions need to be carried out. First, the release branch is merged into master (since every commit on master is a new release by definition, remember). Next, that commit on master must be tagged for easy future reference to this historical version. Finally, the changes made on the release branch need to be merged back into develop, so that future releases also contain these bug fixes.

```
$ git checkout master
Switched to branch 'master'
$ git merge --no-ff release-1.2
Merge made by recursive.
(Summary of changes)
$ git tag -a 1.2
```

```
$ git checkout trunk
Switched to branch 'trunk'
$ git merge --no-ff release-1.2
Merge made by recursive.
(Summary of changes)
```

```
$ git branch -d release-1.2
Deleted branch release-1.2 (was ff452fe).
```


## Hotfix branches

May branch off from:
  *master*
Must merge back into:
  *trunk* and *master*
Branch naming convention:
  hotfix-*


### Creating the hotfix branch

```
$ git checkout -b hotfix-1.2.1 master
Switched to a new branch "hotfix-1.2.1"
$ ./bump-version.sh 1.2.1
Files modified successfully, version bumped to 1.2.1.
$ git commit -a -m "Bumped version number to 1.2.1"
[hotfix-1.2.1 41e61bb] Bumped version number to 1.2.1
1 files changed, 1 insertions(+), 1 deletions(-)
```

```
$ git commit -m "Fixed severe production problem"
[hotfix-1.2.1 abbe5d6] Fixed severe production problem
5 files changed, 32 insertions(+), 17 deletions(-)
```

### Finishing a hotfix branch


```
$ git checkout master
Switched to branch 'master'
$ git merge --no-ff hotfix-1.2.1
Merge made by recursive.
(Summary of changes)
$ git tag -a 1.2.1
```

```
$ git checkout develop
Switched to branch 'develop'
$ git merge --no-ff hotfix-1.2.1
Merge made by recursive.
(Summary of changes)
```

The one exception to the rule here is that, when a release branch currently exists, the hotfix changes need to be merged into that release branch, instead of trunk.

```
$ git branch -d hotfix-1.2.1
Deleted branch hotfix-1.2.1 (was abbe5d6).
```


#### Incorporating code back into a branch
```
$ git checkout trunk
Switched to branch 'trunk'
$ git merge --no-ff myfeature
Updating ea1b82a..05e9557
(Summary of changes)
$ git branch -d myfeature
Deleted branch myfeature (was 05e9557).
$ git push origin trunk
```

The --no-ff flag causes the merge to always create a new commit object, even if the merge could be performed with a fast-forward. This avoids losing information about the historical existence of a feature branch and groups together all commits that together added the feature.
